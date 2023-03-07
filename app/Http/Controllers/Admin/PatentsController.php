<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPatentRequest;
use App\Http\Requests\StorePatentRequest;
use App\Http\Requests\UpdatePatentRequest;
use App\Models\Patent;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PatentsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('patent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Patent::with(['name'])->select(sprintf('%s.*', (new Patent)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'patent_show';
                $editGate      = 'patent_edit';
                $deleteGate    = 'patent_delete';
                $crudRoutePart = 'patents';

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
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'name']);

            return $table->make(true);
        }

        return view('admin.patents.index');
    }

    public function create()
    {
        abort_if(Gate::denies('patent_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.patents.create', compact('names'));
    }

    public function store(StorePatentRequest $request)
    {
        $patent = Patent::create($request->all());

        return redirect()->route('admin.patents.index');
    }

    public function edit(Patent $patent)
    {
        abort_if(Gate::denies('patent_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patent->load('name');

        return view('admin.patents.edit', compact('names', 'patent'));
    }

    public function update(UpdatePatentRequest $request, Patent $patent)
    {
        $patent->update($request->all());

        return redirect()->route('admin.patents.index');
    }

    public function show(Patent $patent)
    {
        abort_if(Gate::denies('patent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patent->load('name');

        return view('admin.patents.show', compact('patent'));
    }

    public function destroy(Patent $patent)
    {
        abort_if(Gate::denies('patent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patent->delete();

        return back();
    }

    public function massDestroy(MassDestroyPatentRequest $request)
    {
        $patents = Patent::find(request('ids'));

        foreach ($patents as $patent) {
            $patent->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
