<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyParentDetailRequest;
use App\Http\Requests\StoreParentDetailRequest;
use App\Http\Requests\UpdateParentDetailRequest;
use App\Models\ParentDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ParentDetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('parent_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ParentDetail::query()->select(sprintf('%s.*', (new ParentDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'parent_detail_show';
                $editGate      = 'parent_detail_edit';
                $deleteGate    = 'parent_detail_delete';
                $crudRoutePart = 'parent-details';

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
            $table->editColumn('father_name', function ($row) {
                return $row->father_name ? $row->father_name : '';
            });
            $table->editColumn('father_mobile_no', function ($row) {
                return $row->father_mobile_no ? $row->father_mobile_no : '';
            });
            $table->editColumn('fathers_occupation', function ($row) {
                return $row->fathers_occupation ? $row->fathers_occupation : '';
            });
            $table->editColumn('mother_name', function ($row) {
                return $row->mother_name ? $row->mother_name : '';
            });
            $table->editColumn('mother_mobile_no', function ($row) {
                return $row->mother_mobile_no ? $row->mother_mobile_no : '';
            });
            $table->editColumn('mothers_occupation', function ($row) {
                return $row->mothers_occupation ? $row->mothers_occupation : '';
            });
            $table->editColumn('guardian_name', function ($row) {
                return $row->guardian_name ? $row->guardian_name : '';
            });
            $table->editColumn('guardian_mobile_no', function ($row) {
                return $row->guardian_mobile_no ? $row->guardian_mobile_no : '';
            });
            $table->editColumn('gaurdian_occupation', function ($row) {
                return $row->gaurdian_occupation ? $row->gaurdian_occupation : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.parentDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('parent_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.parentDetails.create');
    }

    public function store(StoreParentDetailRequest $request)
    {
        $parentDetail = ParentDetail::create($request->all());

        return redirect()->route('admin.parent-details.index');
    }

    public function edit(ParentDetail $parentDetail)
    {
        abort_if(Gate::denies('parent_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.parentDetails.edit', compact('parentDetail'));
    }

    public function update(UpdateParentDetailRequest $request, ParentDetail $parentDetail)
    {
        $parentDetail->update($request->all());

        return redirect()->route('admin.parent-details.index');
    }

    public function show(ParentDetail $parentDetail)
    {
        abort_if(Gate::denies('parent_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.parentDetails.show', compact('parentDetail'));
    }

    public function destroy(ParentDetail $parentDetail)
    {
        abort_if(Gate::denies('parent_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parentDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyParentDetailRequest $request)
    {
        $parentDetails = ParentDetail::find(request('ids'));

        foreach ($parentDetails as $parentDetail) {
            $parentDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
