<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIndustrialTrainingRequest;
use App\Http\Requests\StoreIndustrialTrainingRequest;
use App\Http\Requests\UpdateIndustrialTrainingRequest;
use App\Models\IndustrialTraining;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IndustrialTrainingController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('industrial_training_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IndustrialTraining::with(['name'])->select(sprintf('%s.*', (new IndustrialTraining)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'industrial_training_show';
                $editGate      = 'industrial_training_edit';
                $deleteGate    = 'industrial_training_delete';
                $crudRoutePart = 'industrial-trainings';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('name_name', function ($row) {
                return $row->name ? $row->name->name : '';
            });

            $table->editColumn('topic', function ($row) {
                return $row->topic ? $row->topic : '';
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'name']);

            return $table->make(true);
        }

        return view('admin.industrialTrainings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('industrial_training_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.industrialTrainings.create', compact('names'));
    }

    public function store(StoreIndustrialTrainingRequest $request)
    {
        $industrialTraining = IndustrialTraining::create($request->all());

        return redirect()->route('admin.industrial-trainings.index');
    }

    public function edit(IndustrialTraining $industrialTraining)
    {
        abort_if(Gate::denies('industrial_training_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $industrialTraining->load('name');

        return view('admin.industrialTrainings.edit', compact('industrialTraining', 'names'));
    }

    public function update(UpdateIndustrialTrainingRequest $request, IndustrialTraining $industrialTraining)
    {
        $industrialTraining->update($request->all());

        return redirect()->route('admin.industrial-trainings.index');
    }

    public function show(IndustrialTraining $industrialTraining)
    {
        abort_if(Gate::denies('industrial_training_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industrialTraining->load('name');

        return view('admin.industrialTrainings.show', compact('industrialTraining'));
    }

    public function destroy(IndustrialTraining $industrialTraining)
    {
        abort_if(Gate::denies('industrial_training_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industrialTraining->delete();

        return back();
    }

    public function massDestroy(MassDestroyIndustrialTrainingRequest $request)
    {
        $industrialTrainings = IndustrialTraining::find(request('ids'));

        foreach ($industrialTrainings as $industrialTraining) {
            $industrialTraining->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
