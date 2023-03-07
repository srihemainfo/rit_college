<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOnlineCourseRequest;
use App\Http\Requests\StoreOnlineCourseRequest;
use App\Http\Requests\UpdateOnlineCourseRequest;
use App\Models\OnlineCourse;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OnlineCourseController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('online_course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OnlineCourse::with(['user_name'])->select(sprintf('%s.*', (new OnlineCourse)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'online_course_show';
                $editGate      = 'online_course_edit';
                $deleteGate    = 'online_course_delete';
                $crudRoutePart = 'online-courses';

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

            $table->editColumn('course_name', function ($row) {
                return $row->course_name ? $row->course_name : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_name']);

            return $table->make(true);
        }

        return view('admin.onlineCourses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('online_course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.onlineCourses.create', compact('user_names'));
    }

    public function store(StoreOnlineCourseRequest $request)
    {
        $onlineCourse = OnlineCourse::create($request->all());

        return redirect()->route('admin.online-courses.index');
    }

    public function edit(OnlineCourse $onlineCourse)
    {
        abort_if(Gate::denies('online_course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $onlineCourse->load('user_name');

        return view('admin.onlineCourses.edit', compact('onlineCourse', 'user_names'));
    }

    public function update(UpdateOnlineCourseRequest $request, OnlineCourse $onlineCourse)
    {
        $onlineCourse->update($request->all());

        return redirect()->route('admin.online-courses.index');
    }

    public function show(OnlineCourse $onlineCourse)
    {
        abort_if(Gate::denies('online_course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $onlineCourse->load('user_name');

        return view('admin.onlineCourses.show', compact('onlineCourse'));
    }

    public function destroy(OnlineCourse $onlineCourse)
    {
        abort_if(Gate::denies('online_course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $onlineCourse->delete();

        return back();
    }

    public function massDestroy(MassDestroyOnlineCourseRequest $request)
    {
        $onlineCourses = OnlineCourse::find(request('ids'));

        foreach ($onlineCourses as $onlineCourse) {
            $onlineCourse->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
