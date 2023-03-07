<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEntranceExamRequest;
use App\Http\Requests\StoreEntranceExamRequest;
use App\Http\Requests\UpdateEntranceExamRequest;
use App\Models\EntranceExam;
use App\Models\Examstaff;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EntranceExamsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('entrance_exam_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EntranceExam::with(['name', 'exam_type'])->select(sprintf('%s.*', (new EntranceExam)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'entrance_exam_show';
                $editGate      = 'entrance_exam_edit';
                $deleteGate    = 'entrance_exam_delete';
                $crudRoutePart = 'entrance-exams';

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
            $table->addColumn('name_name', function ($row) {
                return $row->name ? $row->name->name : '';
            });

            $table->addColumn('exam_type_name', function ($row) {
                return $row->exam_type ? $row->exam_type->name : '';
            });

            $table->editColumn('scored_mark', function ($row) {
                return $row->scored_mark ? $row->scored_mark : '';
            });
            $table->editColumn('total_mark', function ($row) {
                return $row->total_mark ? $row->total_mark : '';
            });
            $table->editColumn('rank', function ($row) {
                return $row->rank ? $row->rank : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'name', 'exam_type']);

            return $table->make(true);
        }

        return view('admin.entranceExams.index');
    }

    public function create()
    {
        abort_if(Gate::denies('entrance_exam_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $exam_types = Examstaff::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.entranceExams.create', compact('exam_types', 'names'));
    }

    public function store(StoreEntranceExamRequest $request)
    {
        $entranceExam = EntranceExam::create($request->all());

        return redirect()->route('admin.entrance-exams.index');
    }

    public function edit(EntranceExam $entranceExam)
    {
        abort_if(Gate::denies('entrance_exam_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $exam_types = Examstaff::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entranceExam->load('name', 'exam_type');

        return view('admin.entranceExams.edit', compact('entranceExam', 'exam_types', 'names'));
    }

    public function update(UpdateEntranceExamRequest $request, EntranceExam $entranceExam)
    {
        $entranceExam->update($request->all());

        return redirect()->route('admin.entrance-exams.index');
    }

    public function show(EntranceExam $entranceExam)
    {
        abort_if(Gate::denies('entrance_exam_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entranceExam->load('name', 'exam_type');

        return view('admin.entranceExams.show', compact('entranceExam'));
    }

    public function destroy(EntranceExam $entranceExam)
    {
        abort_if(Gate::denies('entrance_exam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entranceExam->delete();

        return back();
    }

    public function massDestroy(MassDestroyEntranceExamRequest $request)
    {
        $entranceExams = EntranceExam::find(request('ids'));

        foreach ($entranceExams as $entranceExam) {
            $entranceExam->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
