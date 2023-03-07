<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCourseEnrollMasterRequest;
use App\Http\Requests\StoreCourseEnrollMasterRequest;
use App\Http\Requests\UpdateCourseEnrollMasterRequest;
use App\Models\AcademicYear;
use App\Models\Batch;
use App\Models\CourseEnrollMaster;
use App\Models\Section;
use App\Models\Semester;
use App\Models\ToolsCourse;
use App\Models\ToolsDegreeType;
use App\Models\ToolsDepartment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CourseEnrollMasterController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('course_enroll_master_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CourseEnrollMaster::with(['degreetype', 'batch', 'academic', 'course', 'department', 'semester', 'section'])->select(sprintf('%s.*', (new CourseEnrollMaster)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'course_enroll_master_show';
                $editGate      = 'course_enroll_master_edit';
                $deleteGate    = 'course_enroll_master_delete';
                $crudRoutePart = 'course-enroll-masters';

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
            $table->editColumn('enroll_master_number', function ($row) {
                return $row->enroll_master_number ? $row->enroll_master_number : '';
            });
            $table->addColumn('degreetype_name', function ($row) {
                return $row->degreetype ? $row->degreetype->name : '';
            });

            $table->addColumn('batch_name', function ($row) {
                return $row->batch ? $row->batch->name : '';
            });

            $table->addColumn('academic_name', function ($row) {
                return $row->academic ? $row->academic->name : '';
            });

            $table->editColumn('academic.to', function ($row) {
                return $row->academic ? (is_string($row->academic) ? $row->academic : $row->academic->to) : '';
            });
            $table->addColumn('course_name', function ($row) {
                return $row->course ? $row->course->name : '';
            });

            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->addColumn('semester_semester', function ($row) {
                return $row->semester ? $row->semester->semester : '';
            });

            $table->addColumn('section_section', function ($row) {
                return $row->section ? $row->section->section : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'degreetype', 'batch', 'academic', 'course', 'department', 'semester', 'section']);

            return $table->make(true);
        }

        return view('admin.courseEnrollMasters.index');
    }

    public function create()
    {
        abort_if(Gate::denies('course_enroll_master_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $degreetypes = ToolsDegreeType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $academics = AcademicYear::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = ToolsCourse::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = ToolsDepartment::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $semesters = Semester::pluck('semester', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sections = Section::pluck('section', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.courseEnrollMasters.create', compact('academics', 'batches', 'courses', 'degreetypes', 'departments', 'sections', 'semesters'));
    }

    public function store(StoreCourseEnrollMasterRequest $request)
    {
        $courseEnrollMaster = CourseEnrollMaster::create($request->all());

        return redirect()->route('admin.course-enroll-masters.index');
    }

    public function edit(CourseEnrollMaster $courseEnrollMaster)
    {
        abort_if(Gate::denies('course_enroll_master_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $degreetypes = ToolsDegreeType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $academics = AcademicYear::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = ToolsCourse::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departments = ToolsDepartment::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $semesters = Semester::pluck('semester', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sections = Section::pluck('section', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courseEnrollMaster->load('degreetype', 'batch', 'academic', 'course', 'department', 'semester', 'section');

        return view('admin.courseEnrollMasters.edit', compact('academics', 'batches', 'courseEnrollMaster', 'courses', 'degreetypes', 'departments', 'sections', 'semesters'));
    }

    public function update(UpdateCourseEnrollMasterRequest $request, CourseEnrollMaster $courseEnrollMaster)
    {
        $courseEnrollMaster->update($request->all());

        return redirect()->route('admin.course-enroll-masters.index');
    }

    public function show(CourseEnrollMaster $courseEnrollMaster)
    {
        abort_if(Gate::denies('course_enroll_master_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseEnrollMaster->load('degreetype', 'batch', 'academic', 'course', 'department', 'semester', 'section');

        return view('admin.courseEnrollMasters.show', compact('courseEnrollMaster'));
    }

    public function destroy(CourseEnrollMaster $courseEnrollMaster)
    {
        abort_if(Gate::denies('course_enroll_master_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseEnrollMaster->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseEnrollMasterRequest $request)
    {
        $courseEnrollMasters = CourseEnrollMaster::find(request('ids'));

        foreach ($courseEnrollMasters as $courseEnrollMaster) {
            $courseEnrollMaster->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
