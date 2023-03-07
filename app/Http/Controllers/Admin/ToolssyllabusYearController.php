<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyToolssyllabusYearRequest;
use App\Http\Requests\StoreToolssyllabusYearRequest;
use App\Http\Requests\UpdateToolssyllabusYearRequest;
use App\Models\ToolssyllabusYear;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ToolssyllabusYearController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('toolssyllabus_year_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ToolssyllabusYear::query()->select(sprintf('%s.*', (new ToolssyllabusYear)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'toolssyllabus_year_show';
                $editGate      = 'toolssyllabus_year_edit';
                $deleteGate    = 'toolssyllabus_year_delete';
                $crudRoutePart = 'toolssyllabus-years';

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
            $table->editColumn('year', function ($row) {
                return $row->year ? $row->year : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.toolssyllabusYears.index');
    }

    public function create()
    {
        abort_if(Gate::denies('toolssyllabus_year_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolssyllabusYears.create');
    }

    public function store(StoreToolssyllabusYearRequest $request)
    {
        $toolssyllabusYear = ToolssyllabusYear::create($request->all());

        return redirect()->route('admin.toolssyllabus-years.index');
    }

    public function edit(ToolssyllabusYear $toolssyllabusYear)
    {
        abort_if(Gate::denies('toolssyllabus_year_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolssyllabusYears.edit', compact('toolssyllabusYear'));
    }

    public function update(UpdateToolssyllabusYearRequest $request, ToolssyllabusYear $toolssyllabusYear)
    {
        $toolssyllabusYear->update($request->all());

        return redirect()->route('admin.toolssyllabus-years.index');
    }

    public function show(ToolssyllabusYear $toolssyllabusYear)
    {
        abort_if(Gate::denies('toolssyllabus_year_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolssyllabusYears.show', compact('toolssyllabusYear'));
    }

    public function destroy(ToolssyllabusYear $toolssyllabusYear)
    {
        abort_if(Gate::denies('toolssyllabus_year_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toolssyllabusYear->delete();

        return back();
    }

    public function massDestroy(MassDestroyToolssyllabusYearRequest $request)
    {
        $toolssyllabusYears = ToolssyllabusYear::find(request('ids'));

        foreach ($toolssyllabusYears as $toolssyllabusYear) {
            $toolssyllabusYear->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
