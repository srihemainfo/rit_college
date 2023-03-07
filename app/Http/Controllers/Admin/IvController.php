<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIvRequest;
use App\Http\Requests\StoreIvRequest;
use App\Http\Requests\UpdateIvRequest;
use App\Models\Iv;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IvController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('iv_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Iv::with(['name'])->select(sprintf('%s.*', (new Iv)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'iv_show';
                $editGate      = 'iv_edit';
                $deleteGate    = 'iv_delete';
                $crudRoutePart = 'ivs';

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
            $table->addColumn('name_name', function ($row) {
                return $row->name ? $row->name->name : '';
            });

            $table->editColumn('topic', function ($row) {
                return $row->topic ? $row->topic : '';
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });

            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'name']);

            return $table->make(true);
        }

        return view('admin.ivs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('iv_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ivs.create', compact('names'));
    }

    public function store(StoreIvRequest $request)
    {
        $iv = Iv::create($request->all());

        return redirect()->route('admin.ivs.index');
    }

    public function edit(Iv $iv)
    {
        abort_if(Gate::denies('iv_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $iv->load('name');

        return view('admin.ivs.edit', compact('iv', 'names'));
    }

    public function update(UpdateIvRequest $request, Iv $iv)
    {
        $iv->update($request->all());

        return redirect()->route('admin.ivs.index');
    }

    public function show(Iv $iv)
    {
        abort_if(Gate::denies('iv_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iv->load('name');

        return view('admin.ivs.show', compact('iv'));
    }

    public function destroy(Iv $iv)
    {
        abort_if(Gate::denies('iv_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $iv->delete();

        return back();
    }

    public function massDestroy(MassDestroyIvRequest $request)
    {
        $ivs = Iv::find(request('ids'));

        foreach ($ivs as $iv) {
            $iv->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
