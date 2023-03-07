<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAddConferenceRequest;
use App\Http\Requests\StoreAddConferenceRequest;
use App\Http\Requests\UpdateAddConferenceRequest;
use App\Models\AddConference;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AddConferenceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('add_conference_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AddConference::with(['user_name'])->select(sprintf('%s.*', (new AddConference)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'add_conference_show';
                $editGate      = 'add_conference_edit';
                $deleteGate    = 'add_conference_delete';
                $crudRoutePart = 'add-conferences';

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

            $table->editColumn('topic_name', function ($row) {
                return $row->topic_name ? $row->topic_name : '';
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });

            $table->editColumn('contribution_of_conference', function ($row) {
                return $row->contribution_of_conference ? $row->contribution_of_conference : '';
            });
            $table->editColumn('project_name', function ($row) {
                return $row->project_name ? $row->project_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_name']);

            return $table->make(true);
        }

        return view('admin.addConferences.index');
    }

    public function create()
    {
        abort_if(Gate::denies('add_conference_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.addConferences.create', compact('user_names'));
    }

    public function store(StoreAddConferenceRequest $request)
    {
        $addConference = AddConference::create($request->all());

        return redirect()->route('admin.add-conferences.index');
    }

    public function edit(AddConference $addConference)
    {
        abort_if(Gate::denies('add_conference_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addConference->load('user_name');

        return view('admin.addConferences.edit', compact('addConference', 'user_names'));
    }

    public function update(UpdateAddConferenceRequest $request, AddConference $addConference)
    {
        $addConference->update($request->all());

        return redirect()->route('admin.add-conferences.index');
    }

    public function show(AddConference $addConference)
    {
        abort_if(Gate::denies('add_conference_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addConference->load('user_name');

        return view('admin.addConferences.show', compact('addConference'));
    }

    public function destroy(AddConference $addConference)
    {
        abort_if(Gate::denies('add_conference_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addConference->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddConferenceRequest $request)
    {
        $addConferences = AddConference::find(request('ids'));

        foreach ($addConferences as $addConference) {
            $addConference->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
