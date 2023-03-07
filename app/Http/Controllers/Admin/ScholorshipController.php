<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyScholorshipRequest;
use App\Http\Requests\StoreScholorshipRequest;
use App\Http\Requests\UpdateScholorshipRequest;
use App\Models\Scholorship;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ScholorshipController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('scholorship_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Scholorship::query()->select(sprintf('%s.*', (new Scholorship)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'scholorship_show';
                $editGate      = 'scholorship_edit';
                $deleteGate    = 'scholorship_delete';
                $crudRoutePart = 'scholorships';

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

        return view('admin.scholorships.index');
    }

    public function create()
    {
        abort_if(Gate::denies('scholorship_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scholorships.create');
    }

    public function store(StoreScholorshipRequest $request)
    {
        $scholorship = Scholorship::create($request->all());

        return redirect()->route('admin.scholorships.index');
    }

    public function edit(Scholorship $scholorship)
    {
        abort_if(Gate::denies('scholorship_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scholorships.edit', compact('scholorship'));
    }

    public function update(UpdateScholorshipRequest $request, Scholorship $scholorship)
    {
        $scholorship->update($request->all());

        return redirect()->route('admin.scholorships.index');
    }

    public function show(Scholorship $scholorship)
    {
        abort_if(Gate::denies('scholorship_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scholorships.show', compact('scholorship'));
    }

    public function destroy(Scholorship $scholorship)
    {
        abort_if(Gate::denies('scholorship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scholorship->delete();

        return back();
    }

    public function massDestroy(MassDestroyScholorshipRequest $request)
    {
        $scholorships = Scholorship::find(request('ids'));

        foreach ($scholorships as $scholorship) {
            $scholorship->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
