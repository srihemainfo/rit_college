<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyExperienceDetailRequest;
use App\Http\Requests\StoreExperienceDetailRequest;
use App\Http\Requests\UpdateExperienceDetailRequest;
use App\Models\ExperienceDetail;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ExperienceDetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('experience_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ExperienceDetail::with(['name'])->select(sprintf('%s.*', (new ExperienceDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'experience_detail_show';
                $editGate      = 'experience_detail_edit';
                $deleteGate    = 'experience_detail_delete';
                $crudRoutePart = 'experience-details';

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
            $table->editColumn('designation', function ($row) {
                return $row->designation ? $row->designation : '';
            });
            $table->editColumn('years_of_experience', function ($row) {
                return $row->years_of_experience ? $row->years_of_experience : '';
            });
            $table->editColumn('worked_place', function ($row) {
                return $row->worked_place ? $row->worked_place : '';
            });
            $table->editColumn('taken_subjects', function ($row) {
                return $row->taken_subjects ? $row->taken_subjects : '';
            });

            $table->addColumn('name_name', function ($row) {
                return $row->name ? $row->name->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'name']);

            return $table->make(true);
        }

        return view('admin.experienceDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('experience_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.experienceDetails.create', compact('names'));
    }

    public function store(StoreExperienceDetailRequest $request)
    {
        $experienceDetail = ExperienceDetail::create($request->all());

        return redirect()->route('admin.experience-details.index');
    }

    public function edit(ExperienceDetail $experienceDetail)
    {
        abort_if(Gate::denies('experience_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $experienceDetail->load('name');

        return view('admin.experienceDetails.edit', compact('experienceDetail', 'names'));
    }

    public function update(UpdateExperienceDetailRequest $request, ExperienceDetail $experienceDetail)
    {
        $experienceDetail->update($request->all());

        return redirect()->route('admin.experience-details.index');
    }

    public function show(ExperienceDetail $experienceDetail)
    {
        abort_if(Gate::denies('experience_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experienceDetail->load('name');

        return view('admin.experienceDetails.show', compact('experienceDetail'));
    }

    public function destroy(ExperienceDetail $experienceDetail)
    {
        abort_if(Gate::denies('experience_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experienceDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyExperienceDetailRequest $request)
    {
        $experienceDetails = ExperienceDetail::find(request('ids'));

        foreach ($experienceDetails as $experienceDetail) {
            $experienceDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
