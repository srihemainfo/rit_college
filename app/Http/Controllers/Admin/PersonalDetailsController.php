<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPersonalDetailRequest;
use App\Http\Requests\StorePersonalDetailRequest;
use App\Http\Requests\UpdatePersonalDetailRequest;
use App\Models\BloodGroup;
use App\Models\Community;
use App\Models\MotherTongue;
use App\Models\PersonalDetail;
use App\Models\Religion;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PersonalDetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('personal_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PersonalDetail::with(['user_name', 'blood_group', 'mother_tongue', 'religion', 'community'])->select(sprintf('%s.*', (new PersonalDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'personal_detail_show';
                $editGate      = 'personal_detail_edit';
                $deleteGate    = 'personal_detail_delete';
                $crudRoutePart = 'personal-details';

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

            $table->editColumn('age', function ($row) {
                return $row->age ? $row->age : '';
            });

            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('mobile_number', function ($row) {
                return $row->mobile_number ? $row->mobile_number : '';
            });
            $table->editColumn('aadhar_number', function ($row) {
                return $row->aadhar_number ? $row->aadhar_number : '';
            });
            $table->addColumn('blood_group_name', function ($row) {
                return $row->blood_group ? $row->blood_group->name : '';
            });

            $table->addColumn('mother_tongue_mother_tongue', function ($row) {
                return $row->mother_tongue ? $row->mother_tongue->mother_tongue : '';
            });

            $table->addColumn('religion_name', function ($row) {
                return $row->religion ? $row->religion->name : '';
            });

            $table->addColumn('community_name', function ($row) {
                return $row->community ? $row->community->name : '';
            });

            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : '';
            });
            $table->editColumn('country', function ($row) {
                return $row->country ? $row->country : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_name', 'blood_group', 'mother_tongue', 'religion', 'community']);

            return $table->make(true);
        }

        return view('admin.personalDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('personal_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blood_groups = BloodGroup::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mother_tongues = MotherTongue::pluck('mother_tongue', 'id')->prepend(trans('global.pleaseSelect'), '');

        $religions = Religion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $communities = Community::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.personalDetails.create', compact('blood_groups', 'communities', 'mother_tongues', 'religions', 'user_names'));
    }

    public function store(StorePersonalDetailRequest $request)
    {
        $personalDetail = PersonalDetail::create($request->all());

        return redirect()->route('admin.personal-details.index');
    }

    public function edit(PersonalDetail $personalDetail)
    {
        abort_if(Gate::denies('personal_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $blood_groups = BloodGroup::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mother_tongues = MotherTongue::pluck('mother_tongue', 'id')->prepend(trans('global.pleaseSelect'), '');

        $religions = Religion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $communities = Community::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $personalDetail->load('user_name', 'blood_group', 'mother_tongue', 'religion', 'community');

        return view('admin.personalDetails.edit', compact('blood_groups', 'communities', 'mother_tongues', 'personalDetail', 'religions', 'user_names'));
    }

    public function update(UpdatePersonalDetailRequest $request, PersonalDetail $personalDetail)
    {
        $personalDetail->update($request->all());

        return redirect()->route('admin.personal-details.index');
    }

    public function show(PersonalDetail $personalDetail)
    {
        abort_if(Gate::denies('personal_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personalDetail->load('user_name', 'blood_group', 'mother_tongue', 'religion', 'community');

        return view('admin.personalDetails.show', compact('personalDetail'));
    }

    public function destroy(PersonalDetail $personalDetail)
    {
        abort_if(Gate::denies('personal_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $personalDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyPersonalDetailRequest $request)
    {
        $personalDetails = PersonalDetail::find(request('ids'));

        foreach ($personalDetails as $personalDetail) {
            $personalDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
