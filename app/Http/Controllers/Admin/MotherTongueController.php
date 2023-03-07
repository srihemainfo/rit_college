<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMotherTongueRequest;
use App\Http\Requests\StoreMotherTongueRequest;
use App\Http\Requests\UpdateMotherTongueRequest;
use App\Models\MotherTongue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MotherTongueController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('mother_tongue_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MotherTongue::query()->select(sprintf('%s.*', (new MotherTongue)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'mother_tongue_show';
                $editGate      = 'mother_tongue_edit';
                $deleteGate    = 'mother_tongue_delete';
                $crudRoutePart = 'mother-tongues';

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
            $table->editColumn('mother_tongue', function ($row) {
                return $row->mother_tongue ? $row->mother_tongue : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.motherTongues.index');
    }

    public function create()
    {
        abort_if(Gate::denies('mother_tongue_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.motherTongues.create');
    }

    public function store(StoreMotherTongueRequest $request)
    {
        $motherTongue = MotherTongue::create($request->all());

        return redirect()->route('admin.mother-tongues.index');
    }

    public function edit(MotherTongue $motherTongue)
    {
        abort_if(Gate::denies('mother_tongue_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.motherTongues.edit', compact('motherTongue'));
    }

    public function update(UpdateMotherTongueRequest $request, MotherTongue $motherTongue)
    {
        $motherTongue->update($request->all());

        return redirect()->route('admin.mother-tongues.index');
    }

    public function show(MotherTongue $motherTongue)
    {
        abort_if(Gate::denies('mother_tongue_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.motherTongues.show', compact('motherTongue'));
    }

    public function destroy(MotherTongue $motherTongue)
    {
        abort_if(Gate::denies('mother_tongue_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $motherTongue->delete();

        return back();
    }

    public function massDestroy(MassDestroyMotherTongueRequest $request)
    {
        $motherTongues = MotherTongue::find(request('ids'));

        foreach ($motherTongues as $motherTongue) {
            $motherTongue->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
