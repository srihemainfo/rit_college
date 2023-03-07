<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMediumofStudiedRequest;
use App\Http\Requests\StoreMediumofStudiedRequest;
use App\Http\Requests\UpdateMediumofStudiedRequest;
use App\Models\MediumofStudied;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MediumofStudiedController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('mediumof_studied_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MediumofStudied::query()->select(sprintf('%s.*', (new MediumofStudied)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'mediumof_studied_show';
                $editGate      = 'mediumof_studied_edit';
                $deleteGate    = 'mediumof_studied_delete';
                $crudRoutePart = 'mediumof-studieds';

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
            $table->editColumn('medium', function ($row) {
                return $row->medium ? $row->medium : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.mediumofStudieds.index');
    }

    public function create()
    {
        abort_if(Gate::denies('mediumof_studied_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mediumofStudieds.create');
    }

    public function store(StoreMediumofStudiedRequest $request)
    {
        $mediumofStudied = MediumofStudied::create($request->all());

        return redirect()->route('admin.mediumof-studieds.index');
    }

    public function edit(MediumofStudied $mediumofStudied)
    {
        abort_if(Gate::denies('mediumof_studied_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mediumofStudieds.edit', compact('mediumofStudied'));
    }

    public function update(UpdateMediumofStudiedRequest $request, MediumofStudied $mediumofStudied)
    {
        $mediumofStudied->update($request->all());

        return redirect()->route('admin.mediumof-studieds.index');
    }

    public function show(MediumofStudied $mediumofStudied)
    {
        abort_if(Gate::denies('mediumof_studied_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mediumofStudieds.show', compact('mediumofStudied'));
    }

    public function destroy(MediumofStudied $mediumofStudied)
    {
        abort_if(Gate::denies('mediumof_studied_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mediumofStudied->delete();

        return back();
    }

    public function massDestroy(MassDestroyMediumofStudiedRequest $request)
    {
        $mediumofStudieds = MediumofStudied::find(request('ids'));

        foreach ($mediumofStudieds as $mediumofStudied) {
            $mediumofStudied->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
