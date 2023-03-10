<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStaffSalaryRequest;
use App\Http\Requests\StoreStaffSalaryRequest;
use App\Http\Requests\UpdateStaffSalaryRequest;
use App\Models\StaffSalary;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffSalaryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('staff_salary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffSalaries = StaffSalary::all();

        return view('admin.staffSalaries.index', compact('staffSalaries'));
    }

    public function create()
    {
        abort_if(Gate::denies('staff_salary_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staffSalaries.create');
    }

    public function store(StoreStaffSalaryRequest $request)
    {
        $staffSalary = StaffSalary::create($request->all());

        return redirect()->route('admin.staff-salaries.index');
    }

    public function edit(StaffSalary $staffSalary)
    {
        abort_if(Gate::denies('staff_salary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staffSalaries.edit', compact('staffSalary'));
    }

    public function update(UpdateStaffSalaryRequest $request, StaffSalary $staffSalary)
    {
        $staffSalary->update($request->all());

        return redirect()->route('admin.staff-salaries.index');
    }

    public function show(StaffSalary $staffSalary)
    {
        abort_if(Gate::denies('staff_salary_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staffSalaries.show', compact('staffSalary'));
    }

    public function destroy(StaffSalary $staffSalary)
    {
        abort_if(Gate::denies('staff_salary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staffSalary->delete();

        return back();
    }

    public function massDestroy(MassDestroyStaffSalaryRequest $request)
    {
        $staffSalaries = StaffSalary::find(request('ids'));

        foreach ($staffSalaries as $staffSalary) {
            $staffSalary->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
