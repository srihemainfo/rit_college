<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAcademicDetailRequest;
use App\Http\Requests\StoreAcademicDetailRequest;
use App\Http\Requests\UpdateAcademicDetailRequest;
use App\Models\AcademicDetail;
use App\Models\CourseEnrollMaster;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AcademicDetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('academic_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AcademicDetail::with(['enroll_master_number'])->select(sprintf('%s.*', (new AcademicDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'academic_detail_show';
                $editGate      = 'academic_detail_edit';
                $deleteGate    = 'academic_detail_delete';
                $crudRoutePart = 'academic-details';

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
            $table->addColumn('enroll_master_number_enroll_master_number', function ($row) {
                return $row->enroll_master_number ? $row->enroll_master_number->enroll_master_number : '';
            });

            $table->editColumn('register_number', function ($row) {
                return $row->register_number ? $row->register_number : '';
            });
            $table->editColumn('emis_number', function ($row) {
                return $row->emis_number ? $row->emis_number : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'enroll_master_number']);

            return $table->make(true);
        }

        return view('admin.academicDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('academic_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enroll_master_numbers = CourseEnrollMaster::pluck('enroll_master_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.academicDetails.create', compact('enroll_master_numbers'));
    }

    public function store(StoreAcademicDetailRequest $request)
    {
        $academicDetail = AcademicDetail::create($request->all());

        return redirect()->route('admin.academic-details.index');
    }

    public function edit(AcademicDetail $academicDetail)
    {
        abort_if(Gate::denies('academic_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enroll_master_numbers = CourseEnrollMaster::pluck('enroll_master_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $academicDetail->load('enroll_master_number');

        return view('admin.academicDetails.edit', compact('academicDetail', 'enroll_master_numbers'));
    }

    public function update(UpdateAcademicDetailRequest $request, AcademicDetail $academicDetail)
    {
        $academicDetail->update($request->all());

        return redirect()->route('admin.academic-details.index');
    }

    public function show(AcademicDetail $academicDetail)
    {
        abort_if(Gate::denies('academic_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academicDetail->load('enroll_master_number');

        return view('admin.academicDetails.show', compact('academicDetail'));
    }

    public function destroy(AcademicDetail $academicDetail)
    {
        abort_if(Gate::denies('academic_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academicDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyAcademicDetailRequest $request)
    {
        $academicDetails = AcademicDetail::find(request('ids'));

        foreach ($academicDetails as $academicDetail) {
            $academicDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
