<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEducationalDetailRequest;
use App\Http\Requests\StoreEducationalDetailRequest;
use App\Http\Requests\UpdateEducationalDetailRequest;
use App\Models\EducationalDetail;
use App\Models\EducationType;
use App\Models\MediumofStudied;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EducationalDetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('educational_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EducationalDetail::with(['education_type', 'medium'])->select(sprintf('%s.*', (new EducationalDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'educational_detail_show';
                $editGate      = 'educational_detail_edit';
                $deleteGate    = 'educational_detail_delete';
                $crudRoutePart = 'educational-details';

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
            $table->addColumn('education_type_name', function ($row) {
                return $row->education_type ? $row->education_type->name : '';
            });

            $table->editColumn('institute_name', function ($row) {
                return $row->institute_name ? $row->institute_name : '';
            });
            $table->editColumn('institute_location', function ($row) {
                return $row->institute_location ? $row->institute_location : '';
            });
            $table->addColumn('medium_medium', function ($row) {
                return $row->medium ? $row->medium->medium : '';
            });

            $table->editColumn('board_or_university', function ($row) {
                return $row->board_or_university ? $row->board_or_university : '';
            });
            $table->editColumn('marks', function ($row) {
                return $row->marks ? $row->marks : '';
            });
            $table->editColumn('marks_in_percentage', function ($row) {
                return $row->marks_in_percentage ? $row->marks_in_percentage : '';
            });
            $table->editColumn('subject_1', function ($row) {
                return $row->subject_1 ? $row->subject_1 : '';
            });
            $table->editColumn('mark_1', function ($row) {
                return $row->mark_1 ? $row->mark_1 : '';
            });
            $table->editColumn('subject_2', function ($row) {
                return $row->subject_2 ? $row->subject_2 : '';
            });
            $table->editColumn('mark_2', function ($row) {
                return $row->mark_2 ? $row->mark_2 : '';
            });
            $table->editColumn('subject_3', function ($row) {
                return $row->subject_3 ? $row->subject_3 : '';
            });
            $table->editColumn('mark_3', function ($row) {
                return $row->mark_3 ? $row->mark_3 : '';
            });
            $table->editColumn('subject_4', function ($row) {
                return $row->subject_4 ? $row->subject_4 : '';
            });
            $table->editColumn('mark_4', function ($row) {
                return $row->mark_4 ? $row->mark_4 : '';
            });
            $table->editColumn('subject_5', function ($row) {
                return $row->subject_5 ? $row->subject_5 : '';
            });
            $table->editColumn('mark_5', function ($row) {
                return $row->mark_5 ? $row->mark_5 : '';
            });
            $table->editColumn('subject_6', function ($row) {
                return $row->subject_6 ? $row->subject_6 : '';
            });
            $table->editColumn('mark_6', function ($row) {
                return $row->mark_6 ? $row->mark_6 : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'education_type', 'medium']);

            return $table->make(true);
        }

        return view('admin.educationalDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('educational_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $education_types = EducationType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $media = MediumofStudied::pluck('medium', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.educationalDetails.create', compact('education_types', 'media'));
    }

    public function store(StoreEducationalDetailRequest $request)
    {
        $educationalDetail = EducationalDetail::create($request->all());

        return redirect()->route('admin.educational-details.index');
    }

    public function edit(EducationalDetail $educationalDetail)
    {
        abort_if(Gate::denies('educational_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $education_types = EducationType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $media = MediumofStudied::pluck('medium', 'id')->prepend(trans('global.pleaseSelect'), '');

        $educationalDetail->load('education_type', 'medium');

        return view('admin.educationalDetails.edit', compact('education_types', 'educationalDetail', 'media'));
    }

    public function update(UpdateEducationalDetailRequest $request, EducationalDetail $educationalDetail)
    {
        $educationalDetail->update($request->all());

        return redirect()->route('admin.educational-details.index');
    }

    public function show(EducationalDetail $educationalDetail)
    {
        abort_if(Gate::denies('educational_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationalDetail->load('education_type', 'medium');

        return view('admin.educationalDetails.show', compact('educationalDetail'));
    }

    public function destroy(EducationalDetail $educationalDetail)
    {
        abort_if(Gate::denies('educational_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationalDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyEducationalDetailRequest $request)
    {
        $educationalDetails = EducationalDetail::find(request('ids'));

        foreach ($educationalDetails as $educationalDetail) {
            $educationalDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
