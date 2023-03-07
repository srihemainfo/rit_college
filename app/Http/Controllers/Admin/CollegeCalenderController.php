<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCollegeCalenderRequest;
use App\Http\Requests\StoreCollegeCalenderRequest;
use App\Http\Requests\UpdateCollegeCalenderRequest;
use App\Models\CollegeCalender;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CollegeCalenderController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('college_calender_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CollegeCalender::query()->select(sprintf('%s.*', (new CollegeCalender)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'college_calender_show';
                $editGate      = 'college_calender_edit';
                $deleteGate    = 'college_calender_delete';
                $crudRoutePart = 'college-calenders';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('academic_year', function ($row) {
                return $row->academic_year ? $row->academic_year : '';
            });
            $table->editColumn('shift', function ($row) {
                return $row->shift ? $row->shift : '';
            });
            $table->editColumn('semester_type', function ($row) {
                return $row->semester_type ? $row->semester_type : '';
            });
            $table->editColumn('from_date', function ($row) {
                return $row->from_date ? $row->from_date : '';
            });
            $table->editColumn('to_date', function ($row) {
                return $row->to_date ? $row->to_date : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.collegeCalenders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('college_calender_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.collegeCalenders.create');
    }

    public function store(StoreCollegeCalenderRequest $request)
    {
        $collegeCalender = CollegeCalender::create($request->all());

        return redirect()->route('admin.college-calenders.index');
    }

    public function edit(CollegeCalender $collegeCalender)
    {
        abort_if(Gate::denies('college_calender_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.collegeCalenders.edit', compact('collegeCalender'));
    }

    public function update(UpdateCollegeCalenderRequest $request, CollegeCalender $collegeCalender)
    {
        $collegeCalender->update($request->all());

        return redirect()->route('admin.college-calenders.index');
    }

    public function show(CollegeCalender $collegeCalender)
    {
        abort_if(Gate::denies('college_calender_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.collegeCalenders.show', compact('collegeCalender'));
    }

    public function destroy(CollegeCalender $collegeCalender)
    {
        abort_if(Gate::denies('college_calender_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $collegeCalender->delete();

        return back();
    }

    public function massDestroy(MassDestroyCollegeCalenderRequest $request)
    {
        $collegeCalenders = CollegeCalender::find(request('ids'));

        foreach ($collegeCalenders as $collegeCalender) {
            $collegeCalender->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
