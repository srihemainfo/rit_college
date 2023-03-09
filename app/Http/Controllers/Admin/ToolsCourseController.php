<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyToolsCourseRequest;
use App\Http\Requests\StoreToolsCourseRequest;
use App\Http\Requests\UpdateToolsCourseRequest;
use App\Models\ToolsDepartment;
use App\Models\ToolsCourse;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ToolsCourseController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('tools_course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ToolsCourse::with('department')->select(sprintf('%s.*', (new ToolsCourse)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tools_course_show';
                $editGate      = 'tools_course_edit';
                $deleteGate    = 'tools_course_delete';
                $crudRoutePart = 'tools-courses';

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
            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder','department']);

            return $table->make(true);
        }

        return view('admin.toolsCourses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tools_course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = ToolsDepartment::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        return view('admin.toolsCourses.create', compact('departments'));
    }

    public function store(StoreToolsCourseRequest $request)
    {
        $toolsCourse = ToolsCourse::create($request->all());

        return redirect()->route('admin.tools-courses.index');
    }

    public function edit(ToolsCourse $toolsCourse)
    {
        abort_if(Gate::denies('tools_course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = ToolsDepartment::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $toolsCourse->load('department');

        return view('admin.toolsCourses.edit', compact('toolsCourse','departments'));
    }

    public function update(UpdateToolsCourseRequest $request, ToolsCourse $toolsCourse)
    {
        $toolsCourse->update($request->all());

        return redirect()->route('admin.tools-courses.index');
    }

    public function show(ToolsCourse $toolsCourse)
    {
        abort_if(Gate::denies('tools_course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toolsCourse->load('department');

        return view('admin.toolsCourses.show', compact('toolsCourse'));
    }

    public function destroy(ToolsCourse $toolsCourse)
    {
        abort_if(Gate::denies('tools_course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toolsCourse->delete();

        return back();
    }

    public function massDestroy(MassDestroyToolsCourseRequest $request)
    {
        $toolsCourses = ToolsCourse::find(request('ids'));

        foreach ($toolsCourses as $toolsCourse) {
            $toolsCourse->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
