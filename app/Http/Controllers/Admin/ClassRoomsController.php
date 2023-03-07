<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClassRoomRequest;
use App\Http\Requests\StoreClassRoomRequest;
use App\Http\Requests\UpdateClassRoomRequest;
use App\Models\ClassRoom;
use App\Models\CollegeBlock;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClassRoomsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('class_room_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClassRoom::with(['block'])->select(sprintf('%s.*', (new ClassRoom)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'class_room_show';
                $editGate      = 'class_room_edit';
                $deleteGate    = 'class_room_delete';
                $crudRoutePart = 'class-rooms';

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
            $table->addColumn('block_name', function ($row) {
                return $row->block ? $row->block->name : '';
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('room_no', function ($row) {
                return $row->room_no ? $row->room_no : '';
            });
            $table->editColumn('no_of_seat', function ($row) {
                return $row->no_of_seat ? $row->no_of_seat : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'block']);

            return $table->make(true);
        }

        return view('admin.classRooms.index');
    }

    public function create()
    {
        abort_if(Gate::denies('class_room_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blocks = CollegeBlock::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.classRooms.create', compact('blocks'));
    }

    public function store(StoreClassRoomRequest $request)
    {
        $classRoom = ClassRoom::create($request->all());

        return redirect()->route('admin.class-rooms.index');
    }

    public function edit(ClassRoom $classRoom)
    {
        abort_if(Gate::denies('class_room_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blocks = CollegeBlock::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $classRoom->load('block');

        return view('admin.classRooms.edit', compact('blocks', 'classRoom'));
    }

    public function update(UpdateClassRoomRequest $request, ClassRoom $classRoom)
    {
        $classRoom->update($request->all());

        return redirect()->route('admin.class-rooms.index');
    }

    public function show(ClassRoom $classRoom)
    {
        abort_if(Gate::denies('class_room_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classRoom->load('block');

        return view('admin.classRooms.show', compact('classRoom'));
    }

    public function destroy(ClassRoom $classRoom)
    {
        abort_if(Gate::denies('class_room_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classRoom->delete();

        return back();
    }

    public function massDestroy(MassDestroyClassRoomRequest $request)
    {
        $classRooms = ClassRoom::find(request('ids'));

        foreach ($classRooms as $classRoom) {
            $classRoom->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
