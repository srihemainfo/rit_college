<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyToolsDegreeTypeRequest;
use App\Http\Requests\StoreToolsDegreeTypeRequest;
use App\Http\Requests\UpdateToolsDegreeTypeRequest;
use App\Models\ToolsDegreeType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ToolsDegreeTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('tools_degree_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ToolsDegreeType::query()->select(sprintf('%s.*', (new ToolsDegreeType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tools_degree_type_show';
                $editGate      = 'tools_degree_type_edit';
                $deleteGate    = 'tools_degree_type_delete';
                $crudRoutePart = 'tools-degree-types';

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

        return view('admin.toolsDegreeTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tools_degree_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolsDegreeTypes.create');
    }

    public function store(StoreToolsDegreeTypeRequest $request)
    {
        $toolsDegreeType = ToolsDegreeType::create($request->all());

        return redirect()->route('admin.tools-degree-types.index');
    }

    public function edit(ToolsDegreeType $toolsDegreeType)
    {
        abort_if(Gate::denies('tools_degree_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolsDegreeTypes.edit', compact('toolsDegreeType'));
    }

    public function update(UpdateToolsDegreeTypeRequest $request, ToolsDegreeType $toolsDegreeType)
    {
        $toolsDegreeType->update($request->all());

        return redirect()->route('admin.tools-degree-types.index');
    }

    public function show(ToolsDegreeType $toolsDegreeType)
    {
        abort_if(Gate::denies('tools_degree_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toolsDegreeType->load('degreetypeCourseEnrollMasters');

        return view('admin.toolsDegreeTypes.show', compact('toolsDegreeType'));
    }

    public function destroy(ToolsDegreeType $toolsDegreeType)
    {
        abort_if(Gate::denies('tools_degree_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toolsDegreeType->delete();

        return back();
    }

    public function massDestroy(MassDestroyToolsDegreeTypeRequest $request)
    {
        $toolsDegreeTypes = ToolsDegreeType::find(request('ids'));

        foreach ($toolsDegreeTypes as $toolsDegreeType) {
            $toolsDegreeType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
