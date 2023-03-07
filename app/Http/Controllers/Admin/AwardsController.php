<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAwardRequest;
use App\Http\Requests\StoreAwardRequest;
use App\Http\Requests\UpdateAwardRequest;
use App\Models\Award;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AwardsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('award_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Award::with(['user_name'])->select(sprintf('%s.*', (new Award)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'award_show';
                $editGate      = 'award_edit';
                $deleteGate    = 'award_delete';
                $crudRoutePart = 'awards';

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
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_name']);

            return $table->make(true);
        }

        return view('admin.awards.index');
    }

    public function create()
    {
        abort_if(Gate::denies('award_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.awards.create', compact('user_names'));
    }

    public function store(StoreAwardRequest $request)
    {
        $award = Award::create($request->all());

        return redirect()->route('admin.awards.index');
    }

    public function edit(Award $award)
    {
        abort_if(Gate::denies('award_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $award->load('user_name');

        return view('admin.awards.edit', compact('award', 'user_names'));
    }

    public function update(UpdateAwardRequest $request, Award $award)
    {
        $award->update($request->all());

        return redirect()->route('admin.awards.index');
    }

    public function show(Award $award)
    {
        abort_if(Gate::denies('award_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $award->load('user_name');

        return view('admin.awards.show', compact('award'));
    }

    public function destroy(Award $award)
    {
        abort_if(Gate::denies('award_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $award->delete();

        return back();
    }

    public function massDestroy(MassDestroyAwardRequest $request)
    {
        $awards = Award::find(request('ids'));

        foreach ($awards as $award) {
            $award->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
