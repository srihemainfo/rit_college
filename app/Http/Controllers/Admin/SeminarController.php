<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySeminarRequest;
use App\Http\Requests\StoreSeminarRequest;
use App\Http\Requests\UpdateSeminarRequest;
use App\Models\Seminar;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SeminarController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('seminar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Seminar::with(['user_name'])->select(sprintf('%s.*', (new Seminar)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'seminar_show';
                $editGate      = 'seminar_edit';
                $deleteGate    = 'seminar_delete';
                $crudRoutePart = 'seminars';

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

            $table->editColumn('topic', function ($row) {
                return $row->topic ? $row->topic : '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_name']);

            return $table->make(true);
        }

        return view('admin.seminars.index');
    }

    public function create()
    {
        abort_if(Gate::denies('seminar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.seminars.create', compact('user_names'));
    }

    public function store(StoreSeminarRequest $request)
    {
        $seminar = Seminar::create($request->all());

        return redirect()->route('admin.seminars.index');
    }

    public function edit(Seminar $seminar)
    {
        abort_if(Gate::denies('seminar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $seminar->load('user_name');

        return view('admin.seminars.edit', compact('seminar', 'user_names'));
    }

    public function update(UpdateSeminarRequest $request, Seminar $seminar)
    {
        $seminar->update($request->all());

        return redirect()->route('admin.seminars.index');
    }

    public function show(Seminar $seminar)
    {
        abort_if(Gate::denies('seminar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seminar->load('user_name');

        return view('admin.seminars.show', compact('seminar'));
    }

    public function destroy(Seminar $seminar)
    {
        abort_if(Gate::denies('seminar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seminar->delete();

        return back();
    }

    public function massDestroy(MassDestroySeminarRequest $request)
    {
        $seminars = Seminar::find(request('ids'));

        foreach ($seminars as $seminar) {
            $seminar->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
