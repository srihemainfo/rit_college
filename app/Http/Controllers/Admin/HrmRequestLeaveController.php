<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHrmRequestLeafRequest;
use App\Http\Requests\StoreHrmRequestLeafRequest;
use App\Http\Requests\UpdateHrmRequestLeafRequest;
use App\Models\HrmRequestLeaf;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HrmRequestLeaveController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('hrm_request_leaf_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HrmRequestLeaf::with(['user'])->select(sprintf('%s.*', (new HrmRequestLeaf)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'hrm_request_leaf_show';
                $editGate      = 'hrm_request_leaf_edit';
                $deleteGate    = 'hrm_request_leaf_delete';
                $crudRoutePart = 'hrm-request-leaves';

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
            $table->editColumn('from_date', function ($row) {
                return $row->from_date ? $row->from_date : '';
            });
            $table->editColumn('to_date', function ($row) {
                return $row->to_date ? $row->to_date : '';
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

        return view('admin.hrmRequestLeaves.index');
    }

    public function create()
    {
        abort_if(Gate::denies('hrm_request_leaf_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.hrmRequestLeaves.create', compact('users'));
    }

    public function store(StoreHrmRequestLeafRequest $request)
    {
        $hrmRequestLeaf = HrmRequestLeaf::create($request->all());

        return redirect()->route('admin.hrm-request-leaves.index');
    }

    public function edit(HrmRequestLeaf $hrmRequestLeaf)
    {
        abort_if(Gate::denies('hrm_request_leaf_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hrmRequestLeaf->load('user');

        return view('admin.hrmRequestLeaves.edit', compact('hrmRequestLeaf', 'users'));
    }

    public function update(UpdateHrmRequestLeafRequest $request, HrmRequestLeaf $hrmRequestLeaf)
    {
        $hrmRequestLeaf->update($request->all());

        return redirect()->route('admin.hrm-request-leaves.index');
    }

    public function show(HrmRequestLeaf $hrmRequestLeaf)
    {
        abort_if(Gate::denies('hrm_request_leaf_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hrmRequestLeaf->load('user');

        return view('admin.hrmRequestLeaves.show', compact('hrmRequestLeaf'));
    }

    public function destroy(HrmRequestLeaf $hrmRequestLeaf)
    {
        abort_if(Gate::denies('hrm_request_leaf_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hrmRequestLeaf->delete();

        return back();
    }

    public function massDestroy(MassDestroyHrmRequestLeafRequest $request)
    {
        $hrmRequestLeaves = HrmRequestLeaf::find(request('ids'));

        foreach ($hrmRequestLeaves as $hrmRequestLeaf) {
            $hrmRequestLeaf->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
