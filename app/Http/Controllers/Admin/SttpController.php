<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySttpRequest;
use App\Http\Requests\StoreSttpRequest;
use App\Http\Requests\UpdateSttpRequest;
use App\Models\Sttp;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SttpController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sttp_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Sttp::with(['name'])->select(sprintf('%s.*', (new Sttp)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sttp_show';
                $editGate      = 'sttp_edit';
                $deleteGate    = 'sttp_delete';
                $crudRoutePart = 'sttps';

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
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'name']);

            return $table->make(true);
        }

        return view('admin.sttps.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sttp_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sttps.create', compact('names'));
    }

    public function store(StoreSttpRequest $request)
    {
        $sttp = Sttp::create($request->all());

        return redirect()->route('admin.sttps.index');
    }

    public function edit(Sttp $sttp)
    {
        abort_if(Gate::denies('sttp_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sttp->load('name');

        return view('admin.sttps.edit', compact('names', 'sttp'));
    }

    public function update(UpdateSttpRequest $request, Sttp $sttp)
    {
        $sttp->update($request->all());

        return redirect()->route('admin.sttps.index');
    }

    public function show(Sttp $sttp)
    {
        abort_if(Gate::denies('sttp_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sttp->load('name');

        return view('admin.sttps.show', compact('sttp'));
    }

    public function destroy(Sttp $sttp)
    {
        abort_if(Gate::denies('sttp_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sttp->delete();

        return back();
    }

    public function massDestroy(MassDestroySttpRequest $request)
    {
        $sttps = Sttp::find(request('ids'));

        foreach ($sttps as $sttp) {
            $sttp->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
