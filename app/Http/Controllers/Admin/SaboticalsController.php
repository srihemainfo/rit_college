<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySaboticalRequest;
use App\Http\Requests\StoreSaboticalRequest;
use App\Http\Requests\UpdateSaboticalRequest;
use App\Models\Sabotical;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SaboticalsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sabotical_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Sabotical::with(['name'])->select(sprintf('%s.*', (new Sabotical)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sabotical_show';
                $editGate      = 'sabotical_edit';
                $deleteGate    = 'sabotical_delete';
                $crudRoutePart = 'saboticals';

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
            $table->editColumn('eligiblity_approve', function ($row) {
                return $row->eligiblity_approve ? $row->eligiblity_approve : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'name']);

            return $table->make(true);
        }

        return view('admin.saboticals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sabotical_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.saboticals.create', compact('names'));
    }

    public function store(StoreSaboticalRequest $request)
    {
        $sabotical = Sabotical::create($request->all());

        return redirect()->route('admin.saboticals.index');
    }

    public function edit(Sabotical $sabotical)
    {
        abort_if(Gate::denies('sabotical_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sabotical->load('name');

        return view('admin.saboticals.edit', compact('names', 'sabotical'));
    }

    public function update(UpdateSaboticalRequest $request, Sabotical $sabotical)
    {
        $sabotical->update($request->all());

        return redirect()->route('admin.saboticals.index');
    }

    public function show(Sabotical $sabotical)
    {
        abort_if(Gate::denies('sabotical_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sabotical->load('name');

        return view('admin.saboticals.show', compact('sabotical'));
    }

    public function destroy(Sabotical $sabotical)
    {
        abort_if(Gate::denies('sabotical_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sabotical->delete();

        return back();
    }

    public function massDestroy(MassDestroySaboticalRequest $request)
    {
        $saboticals = Sabotical::find(request('ids'));

        foreach ($saboticals as $sabotical) {
            $sabotical->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
