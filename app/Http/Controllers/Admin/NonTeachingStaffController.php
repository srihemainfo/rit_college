<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyNonTeachingStaffRequest;
use App\Http\Requests\StoreNonTeachingStaffRequest;
use App\Http\Requests\UpdateNonTeachingStaffRequest;
use App\Models\NonTeachingStaff;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NonTeachingStaffController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('non_teaching_staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = NonTeachingStaff::with(['working_as'])->select(sprintf('%s.*', (new NonTeachingStaff)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'non_teaching_staff_show';
                $editGate      = 'non_teaching_staff_edit';
                $deleteGate    = 'non_teaching_staff_delete';
                $crudRoutePart = 'non-teaching-staffs';

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
            $table->addColumn('working_as_title', function ($row) {
                return $row->working_as ? $row->working_as->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'working_as']);

            return $table->make(true);
        }

        return view('admin.nonTeachingStaffs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('non_teaching_staff_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $working_as = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.nonTeachingStaffs.create', compact('working_as'));
    }

    public function store(StoreNonTeachingStaffRequest $request)
    {
        $nonTeachingStaff = NonTeachingStaff::create($request->all());

        return redirect()->route('admin.non-teaching-staffs.index');
    }

    public function edit(NonTeachingStaff $nonTeachingStaff)
    {
        abort_if(Gate::denies('non_teaching_staff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $working_as = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nonTeachingStaff->load('working_as');

        return view('admin.nonTeachingStaffs.edit', compact('nonTeachingStaff', 'working_as'));
    }

    public function update(UpdateNonTeachingStaffRequest $request, NonTeachingStaff $nonTeachingStaff)
    {
        $nonTeachingStaff->update($request->all());

        return redirect()->route('admin.non-teaching-staffs.index');
    }

    public function show(NonTeachingStaff $nonTeachingStaff)
    {
        abort_if(Gate::denies('non_teaching_staff_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nonTeachingStaff->load('working_as');

        return view('admin.nonTeachingStaffs.show', compact('nonTeachingStaff'));
    }

    public function destroy(NonTeachingStaff $nonTeachingStaff)
    {
        abort_if(Gate::denies('non_teaching_staff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nonTeachingStaff->delete();

        return back();
    }

    public function massDestroy(MassDestroyNonTeachingStaffRequest $request)
    {
        $nonTeachingStaffs = NonTeachingStaff::find(request('ids'));

        foreach ($nonTeachingStaffs as $nonTeachingStaff) {
            $nonTeachingStaff->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
