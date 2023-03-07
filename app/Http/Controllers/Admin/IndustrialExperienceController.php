<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIndustrialExperienceRequest;
use App\Http\Requests\StoreIndustrialExperienceRequest;
use App\Http\Requests\UpdateIndustrialExperienceRequest;
use App\Models\IndustrialExperience;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IndustrialExperienceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('industrial_experience_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IndustrialExperience::with(['user_name'])->select(sprintf('%s.*', (new IndustrialExperience)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'industrial_experience_show';
                $editGate      = 'industrial_experience_edit';
                $deleteGate    = 'industrial_experience_delete';
                $crudRoutePart = 'industrial-experiences';

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
            $table->addColumn('user_name_name', function ($row) {
                return $row->user_name ? $row->user_name->name : '';
            });

            $table->editColumn('work_experience', function ($row) {
                return $row->work_experience ? $row->work_experience : '';
            });
            $table->editColumn('designation', function ($row) {
                return $row->designation ? $row->designation : '';
            });

            $table->editColumn('work_type', function ($row) {
                return $row->work_type ? $row->work_type : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_name']);

            return $table->make(true);
        }

        return view('admin.industrialExperiences.index');
    }

    public function create()
    {
        abort_if(Gate::denies('industrial_experience_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.industrialExperiences.create', compact('user_names'));
    }

    public function store(StoreIndustrialExperienceRequest $request)
    {
        $industrialExperience = IndustrialExperience::create($request->all());

        return redirect()->route('admin.industrial-experiences.index');
    }

    public function edit(IndustrialExperience $industrialExperience)
    {
        abort_if(Gate::denies('industrial_experience_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $industrialExperience->load('user_name');

        return view('admin.industrialExperiences.edit', compact('industrialExperience', 'user_names'));
    }

    public function update(UpdateIndustrialExperienceRequest $request, IndustrialExperience $industrialExperience)
    {
        $industrialExperience->update($request->all());

        return redirect()->route('admin.industrial-experiences.index');
    }

    public function show(IndustrialExperience $industrialExperience)
    {
        abort_if(Gate::denies('industrial_experience_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industrialExperience->load('user_name');

        return view('admin.industrialExperiences.show', compact('industrialExperience'));
    }

    public function destroy(IndustrialExperience $industrialExperience)
    {
        abort_if(Gate::denies('industrial_experience_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $industrialExperience->delete();

        return back();
    }

    public function massDestroy(MassDestroyIndustrialExperienceRequest $request)
    {
        $industrialExperiences = IndustrialExperience::find(request('ids'));

        foreach ($industrialExperiences as $industrialExperience) {
            $industrialExperience->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
