<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTeachingStaffRequest;
use App\Http\Requests\StoreTeachingStaffRequest;
use App\Http\Requests\UpdateTeachingStaffRequest;
use App\Models\CourseEnrollMaster;
use App\Models\Role;
use App\Models\Subject;
use App\Models\TeachingStaff;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TeachingStaffController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('teaching_staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TeachingStaff::with(['subject', 'enroll_master', 'working_as'])->select(sprintf('%s.*', (new TeachingStaff)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'teaching_staff_show';
                $editGate      = 'teaching_staff_edit';
                $deleteGate    = 'teaching_staff_delete';
                $crudRoutePart = 'teaching-staffs';

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
            $table->addColumn('subject_name', function ($row) {
                return $row->subject ? $row->subject->name : '';
            });

            $table->addColumn('enroll_master_enroll_master_number', function ($row) {
                return $row->enroll_master ? $row->enroll_master->enroll_master_number : '';
            });

            $table->addColumn('working_as_title', function ($row) {
                return $row->working_as ? $row->working_as->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'subject', 'enroll_master', 'working_as']);

            return $table->make(true);
        }

        return view('admin.teachingStaffs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('teaching_staff_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = Subject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $enroll_masters = CourseEnrollMaster::pluck('enroll_master_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $working_as = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.teachingStaffs.create', compact('enroll_masters', 'subjects', 'working_as'));
    }

    public function store(StoreTeachingStaffRequest $request)
    {
        $teachingStaff = TeachingStaff::create($request->all());

        return redirect()->route('admin.teaching-staffs.index');
    }

    public function edit(TeachingStaff $teachingStaff)
    {
        abort_if(Gate::denies('teaching_staff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjects = Subject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $enroll_masters = CourseEnrollMaster::pluck('enroll_master_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $working_as = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teachingStaff->load('subject', 'enroll_master', 'working_as');

        return view('admin.teachingStaffs.edit', compact('enroll_masters', 'subjects', 'teachingStaff', 'working_as'));
    }

    public function update(UpdateTeachingStaffRequest $request, TeachingStaff $teachingStaff)
    {
        $teachingStaff->update($request->all());

        return redirect()->route('admin.teaching-staffs.index');
    }

    public function show(TeachingStaff $teachingStaff)
    {
        abort_if(Gate::denies('teaching_staff_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teachingStaff->load('subject', 'enroll_master', 'working_as');

        return view('admin.teachingStaffs.show', compact('teachingStaff'));
    }

    public function destroy(TeachingStaff $teachingStaff)
    {
        abort_if(Gate::denies('teaching_staff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teachingStaff->delete();

        return back();
    }

    public function massDestroy(MassDestroyTeachingStaffRequest $request)
    {
        $teachingStaffs = TeachingStaff::find(request('ids'));

        foreach ($teachingStaffs as $teachingStaff) {
            $teachingStaff->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
