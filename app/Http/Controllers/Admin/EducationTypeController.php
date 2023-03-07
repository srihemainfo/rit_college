<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEducationTypeRequest;
use App\Http\Requests\StoreEducationTypeRequest;
use App\Http\Requests\UpdateEducationTypeRequest;
use App\Models\EducationType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EducationTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('education_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EducationType::query()->select(sprintf('%s.*', (new EducationType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'education_type_show';
                $editGate      = 'education_type_edit';
                $deleteGate    = 'education_type_delete';
                $crudRoutePart = 'education-types';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.educationTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('education_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.educationTypes.create');
    }

    public function store(StoreEducationTypeRequest $request)
    {
        $educationType = EducationType::create($request->all());

        return redirect()->route('admin.education-types.index');
    }

    public function edit(EducationType $educationType)
    {
        abort_if(Gate::denies('education_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.educationTypes.edit', compact('educationType'));
    }

    public function update(UpdateEducationTypeRequest $request, EducationType $educationType)
    {
        $educationType->update($request->all());

        return redirect()->route('admin.education-types.index');
    }

    public function show(EducationType $educationType)
    {
        abort_if(Gate::denies('education_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.educationTypes.show', compact('educationType'));
    }

    public function destroy(EducationType $educationType)
    {
        abort_if(Gate::denies('education_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationType->delete();

        return back();
    }

    public function massDestroy(MassDestroyEducationTypeRequest $request)
    {
        $educationTypes = EducationType::find(request('ids'));

        foreach ($educationTypes as $educationType) {
            $educationType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
