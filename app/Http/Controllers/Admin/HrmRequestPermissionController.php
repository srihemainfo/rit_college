<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHrmRequestPermissionRequest;
use App\Http\Requests\StoreHrmRequestPermissionRequest;
use App\Http\Requests\UpdateHrmRequestPermissionRequest;
use App\Models\HrmRequestPermission;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HrmRequestPermissionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('hrm_request_permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HrmRequestPermission::with(['user'])->select(sprintf('%s.*', (new HrmRequestPermission)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'hrm_request_permission_show';
                $editGate      = 'hrm_request_permission_edit';
                $deleteGate    = 'hrm_request_permission_delete';
                $crudRoutePart = 'hrm-request-permissions';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });
            $table->editColumn('user.email_verified_at', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email_verified_at) : '';
            });
            $table->editColumn('user.remember_token', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->remember_token) : '';
            });
            $table->editColumn('user.two_factor', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->two_factor) : '';
            });
            $table->editColumn('user.two_factor_code', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->two_factor_code) : '';
            });
            $table->editColumn('user.two_factor_expires_at', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->two_factor_expires_at) : '';
            });
            $table->editColumn('no_of_hours', function ($row) {
                return $row->no_of_hours ? $row->no_of_hours : '';
            });
            $table->editColumn('from_date', function ($row) {
                return $row->from_date ? $row->from_date : '';
            });
            $table->editColumn('reason', function ($row) {
                return $row->reason ? $row->reason : '';
            });
            $table->editColumn('approved_by', function ($row) {
                return $row->approved_by ? $row->approved_by : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.hrmRequestPermissions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('hrm_request_permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.hrmRequestPermissions.create', compact('users'));
    }

    public function store(StoreHrmRequestPermissionRequest $request)
    {
        $hrmRequestPermission = HrmRequestPermission::create($request->all());

        return redirect()->route('admin.hrm-request-permissions.index');
    }

    public function edit(HrmRequestPermission $hrmRequestPermission)
    {
        abort_if(Gate::denies('hrm_request_permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hrmRequestPermission->load('user');

        return view('admin.hrmRequestPermissions.edit', compact('hrmRequestPermission', 'users'));
    }

    public function update(UpdateHrmRequestPermissionRequest $request, HrmRequestPermission $hrmRequestPermission)
    {
        $hrmRequestPermission->update($request->all());

        return redirect()->route('admin.hrm-request-permissions.index');
    }

    public function show(HrmRequestPermission $hrmRequestPermission)
    {
        abort_if(Gate::denies('hrm_request_permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hrmRequestPermission->load('user');

        return view('admin.hrmRequestPermissions.show', compact('hrmRequestPermission'));
    }

    public function destroy(HrmRequestPermission $hrmRequestPermission)
    {
        abort_if(Gate::denies('hrm_request_permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hrmRequestPermission->delete();

        return back();
    }

    public function massDestroy(MassDestroyHrmRequestPermissionRequest $request)
    {
        $hrmRequestPermissions = HrmRequestPermission::find(request('ids'));

        foreach ($hrmRequestPermissions as $hrmRequestPermission) {
            $hrmRequestPermission->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
