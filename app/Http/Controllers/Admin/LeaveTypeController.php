<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLeaveTypeRequest;
use App\Http\Requests\StoreLeaveTypeRequest;
use App\Http\Requests\UpdateLeaveTypeRequest;
use App\Models\LeaveType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LeaveTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('leave_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LeaveType::query()->select(sprintf('%s.*', (new LeaveType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'leave_type_show';
                $editGate      = 'leave_type_edit';
                $deleteGate    = 'leave_type_delete';
                $crudRoutePart = 'leave-types';

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

        return view('admin.leaveTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('leave_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.leaveTypes.create');
    }

    public function store(StoreLeaveTypeRequest $request)
    {
        $leaveType = LeaveType::create($request->all());

        return redirect()->route('admin.leave-types.index');
    }

    public function edit(LeaveType $leaveType)
    {
        abort_if(Gate::denies('leave_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.leaveTypes.edit', compact('leaveType'));
    }

    public function update(UpdateLeaveTypeRequest $request, LeaveType $leaveType)
    {
        $leaveType->update($request->all());

        return redirect()->route('admin.leave-types.index');
    }

    public function show(LeaveType $leaveType)
    {
        abort_if(Gate::denies('leave_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.leaveTypes.show', compact('leaveType'));
    }

    public function destroy(LeaveType $leaveType)
    {
        abort_if(Gate::denies('leave_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leaveType->delete();

        return back();
    }

    public function massDestroy(MassDestroyLeaveTypeRequest $request)
    {
        $leaveTypes = LeaveType::find(request('ids'));

        foreach ($leaveTypes as $leaveType) {
            $leaveType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
