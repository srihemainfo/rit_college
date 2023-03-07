<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInternRequest;
use App\Http\Requests\StoreInternRequest;
use App\Http\Requests\UpdateInternRequest;
use App\Models\Intern;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InternController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('intern_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Intern::with(['name'])->select(sprintf('%s.*', (new Intern)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'intern_show';
                $editGate      = 'intern_edit';
                $deleteGate    = 'intern_delete';
                $crudRoutePart = 'interns';

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

            $table->editColumn('progress_report', function ($row) {
                return $row->progress_report ? $row->progress_report : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'name']);

            return $table->make(true);
        }

        return view('admin.interns.index');
    }

    public function create()
    {
        abort_if(Gate::denies('intern_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.interns.create', compact('names'));
    }

    public function store(StoreInternRequest $request)
    {
        $intern = Intern::create($request->all());

        return redirect()->route('admin.interns.index');
    }

    public function edit(Intern $intern)
    {
        abort_if(Gate::denies('intern_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $intern->load('name');

        return view('admin.interns.edit', compact('intern', 'names'));
    }

    public function update(UpdateInternRequest $request, Intern $intern)
    {
        $intern->update($request->all());

        return redirect()->route('admin.interns.index');
    }

    public function show(Intern $intern)
    {
        abort_if(Gate::denies('intern_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $intern->load('name');

        return view('admin.interns.show', compact('intern'));
    }

    public function destroy(Intern $intern)
    {
        abort_if(Gate::denies('intern_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $intern->delete();

        return back();
    }

    public function massDestroy(MassDestroyInternRequest $request)
    {
        $interns = Intern::find(request('ids'));

        foreach ($interns as $intern) {
            $intern->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
