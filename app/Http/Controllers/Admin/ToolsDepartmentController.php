<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyToolsDepartmentRequest;
use App\Http\Requests\StoreToolsDepartmentRequest;
use App\Http\Requests\UpdateToolsDepartmentRequest;
use App\Models\ToolsDepartment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ToolsDepartmentController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('tools_department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ToolsDepartment::query()->select(sprintf('%s.*', (new ToolsDepartment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tools_department_show';
                $editGate      = 'tools_department_edit';
                $deleteGate    = 'tools_department_delete';
                $crudRoutePart = 'tools-departments';

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

        return view('admin.toolsDepartments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tools_department_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolsDepartments.create');
    }

    public function store(StoreToolsDepartmentRequest $request)
    {
        $toolsDepartment = ToolsDepartment::create($request->all());

        return redirect()->route('admin.tools-departments.index');
    }

    public function edit(ToolsDepartment $toolsDepartment)
    {
        abort_if(Gate::denies('tools_department_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolsDepartments.edit', compact('toolsDepartment'));
    }

    public function update(UpdateToolsDepartmentRequest $request, ToolsDepartment $toolsDepartment)
    {
        $toolsDepartment->update($request->all());

        return redirect()->route('admin.tools-departments.index');
    }

    public function show(ToolsDepartment $toolsDepartment)
    {
        abort_if(Gate::denies('tools_department_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolsDepartments.show', compact('toolsDepartment'));
    }

    public function destroy(ToolsDepartment $toolsDepartment)
    {
        abort_if(Gate::denies('tools_department_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toolsDepartment->delete();

        return back();
    }

    public function massDestroy(MassDestroyToolsDepartmentRequest $request)
    {
        $toolsDepartments = ToolsDepartment::find(request('ids'));

        foreach ($toolsDepartments as $toolsDepartment) {
            $toolsDepartment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
