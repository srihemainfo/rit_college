<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySponserRequest;
use App\Http\Requests\StoreSponserRequest;
use App\Http\Requests\UpdateSponserRequest;
use App\Models\Sponser;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SponserController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sponser_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Sponser::with(['user_name'])->select(sprintf('%s.*', (new Sponser)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sponser_show';
                $editGate      = 'sponser_edit';
                $deleteGate    = 'sponser_delete';
                $crudRoutePart = 'sponsers';

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

            $table->editColumn('sponser_type', function ($row) {
                return $row->sponser_type ? $row->sponser_type : '';
            });
            $table->editColumn('sponser_name', function ($row) {
                return $row->sponser_name ? $row->sponser_name : '';
            });
            $table->editColumn('sponsered_items', function ($row) {
                return $row->sponsered_items ? $row->sponsered_items : '';
            });
            $table->editColumn('sponsered_to', function ($row) {
                return $row->sponsered_to ? $row->sponsered_to : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_name']);

            return $table->make(true);
        }

        return view('admin.sponsers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sponser_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sponsers.create', compact('user_names'));
    }

    public function store(StoreSponserRequest $request)
    {
        $sponser = Sponser::create($request->all());

        return redirect()->route('admin.sponsers.index');
    }

    public function edit(Sponser $sponser)
    {
        abort_if(Gate::denies('sponser_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sponser->load('user_name');

        return view('admin.sponsers.edit', compact('sponser', 'user_names'));
    }

    public function update(UpdateSponserRequest $request, Sponser $sponser)
    {
        $sponser->update($request->all());

        return redirect()->route('admin.sponsers.index');
    }

    public function show(Sponser $sponser)
    {
        abort_if(Gate::denies('sponser_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponser->load('user_name');

        return view('admin.sponsers.show', compact('sponser'));
    }

    public function destroy(Sponser $sponser)
    {
        abort_if(Gate::denies('sponser_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponser->delete();

        return back();
    }

    public function massDestroy(MassDestroySponserRequest $request)
    {
        $sponsers = Sponser::find(request('ids'));

        foreach ($sponsers as $sponser) {
            $sponser->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
