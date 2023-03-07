<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCommunityRequest;
use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Models\Community;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CommunityController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('community_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Community::query()->select(sprintf('%s.*', (new Community)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'community_show';
                $editGate      = 'community_edit';
                $deleteGate    = 'community_delete';
                $crudRoutePart = 'communities';

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

        return view('admin.communities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('community_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.communities.create');
    }

    public function store(StoreCommunityRequest $request)
    {
        $community = Community::create($request->all());

        return redirect()->route('admin.communities.index');
    }

    public function edit(Community $community)
    {
        abort_if(Gate::denies('community_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.communities.edit', compact('community'));
    }

    public function update(UpdateCommunityRequest $request, Community $community)
    {
        $community->update($request->all());

        return redirect()->route('admin.communities.index');
    }

    public function show(Community $community)
    {
        abort_if(Gate::denies('community_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.communities.show', compact('community'));
    }

    public function destroy(Community $community)
    {
        abort_if(Gate::denies('community_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $community->delete();

        return back();
    }

    public function massDestroy(MassDestroyCommunityRequest $request)
    {
        $communities = Community::find(request('ids'));

        foreach ($communities as $community) {
            $community->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
