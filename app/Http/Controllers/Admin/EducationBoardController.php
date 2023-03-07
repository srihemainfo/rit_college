<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEducationBoardRequest;
use App\Http\Requests\StoreEducationBoardRequest;
use App\Http\Requests\UpdateEducationBoardRequest;
use App\Models\EducationBoard;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EducationBoardController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('education_board_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EducationBoard::query()->select(sprintf('%s.*', (new EducationBoard)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'education_board_show';
                $editGate      = 'education_board_edit';
                $deleteGate    = 'education_board_delete';
                $crudRoutePart = 'education-boards';

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
            $table->editColumn('education_board', function ($row) {
                return $row->education_board ? $row->education_board : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.educationBoards.index');
    }

    public function create()
    {
        abort_if(Gate::denies('education_board_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.educationBoards.create');
    }

    public function store(StoreEducationBoardRequest $request)
    {
        $educationBoard = EducationBoard::create($request->all());

        return redirect()->route('admin.education-boards.index');
    }

    public function edit(EducationBoard $educationBoard)
    {
        abort_if(Gate::denies('education_board_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.educationBoards.edit', compact('educationBoard'));
    }

    public function update(UpdateEducationBoardRequest $request, EducationBoard $educationBoard)
    {
        $educationBoard->update($request->all());

        return redirect()->route('admin.education-boards.index');
    }

    public function show(EducationBoard $educationBoard)
    {
        abort_if(Gate::denies('education_board_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.educationBoards.show', compact('educationBoard'));
    }

    public function destroy(EducationBoard $educationBoard)
    {
        abort_if(Gate::denies('education_board_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationBoard->delete();

        return back();
    }

    public function massDestroy(MassDestroyEducationBoardRequest $request)
    {
        $educationBoards = EducationBoard::find(request('ids'));

        foreach ($educationBoards as $educationBoard) {
            $educationBoard->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
