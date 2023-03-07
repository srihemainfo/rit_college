<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGuestLectureRequest;
use App\Http\Requests\StoreGuestLectureRequest;
use App\Http\Requests\UpdateGuestLectureRequest;
use App\Models\GuestLecture;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GuestLectureController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('guest_lecture_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GuestLecture::with(['user_name'])->select(sprintf('%s.*', (new GuestLecture)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'guest_lecture_show';
                $editGate      = 'guest_lecture_edit';
                $deleteGate    = 'guest_lecture_delete';
                $crudRoutePart = 'guest-lectures';

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
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_name']);

            return $table->make(true);
        }

        return view('admin.guestLectures.index');
    }

    public function create()
    {
        abort_if(Gate::denies('guest_lecture_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.guestLectures.create', compact('user_names'));
    }

    public function store(StoreGuestLectureRequest $request)
    {
        $guestLecture = GuestLecture::create($request->all());

        return redirect()->route('admin.guest-lectures.index');
    }

    public function edit(GuestLecture $guestLecture)
    {
        abort_if(Gate::denies('guest_lecture_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_names = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $guestLecture->load('user_name');

        return view('admin.guestLectures.edit', compact('guestLecture', 'user_names'));
    }

    public function update(UpdateGuestLectureRequest $request, GuestLecture $guestLecture)
    {
        $guestLecture->update($request->all());

        return redirect()->route('admin.guest-lectures.index');
    }

    public function show(GuestLecture $guestLecture)
    {
        abort_if(Gate::denies('guest_lecture_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guestLecture->load('user_name');

        return view('admin.guestLectures.show', compact('guestLecture'));
    }

    public function destroy(GuestLecture $guestLecture)
    {
        abort_if(Gate::denies('guest_lecture_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guestLecture->delete();

        return back();
    }

    public function massDestroy(MassDestroyGuestLectureRequest $request)
    {
        $guestLectures = GuestLecture::find(request('ids'));

        foreach ($guestLectures as $guestLecture) {
            $guestLecture->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
