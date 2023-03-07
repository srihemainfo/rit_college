<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBankAccountDetailRequest;
use App\Http\Requests\StoreBankAccountDetailRequest;
use App\Http\Requests\UpdateBankAccountDetailRequest;
use App\Models\BankAccountDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BankAccountDetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bank_account_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BankAccountDetail::query()->select(sprintf('%s.*', (new BankAccountDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bank_account_detail_show';
                $editGate      = 'bank_account_detail_edit';
                $deleteGate    = 'bank_account_detail_delete';
                $crudRoutePart = 'bank-account-details';

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
            $table->editColumn('account_type', function ($row) {
                return $row->account_type ? $row->account_type : '';
            });
            $table->editColumn('account_no', function ($row) {
                return $row->account_no ? $row->account_no : '';
            });
            $table->editColumn('ifsc_code', function ($row) {
                return $row->ifsc_code ? $row->ifsc_code : '';
            });
            $table->editColumn('bank_name', function ($row) {
                return $row->bank_name ? $row->bank_name : '';
            });
            $table->editColumn('branch_name', function ($row) {
                return $row->branch_name ? $row->branch_name : '';
            });
            $table->editColumn('bank_location', function ($row) {
                return $row->bank_location ? $row->bank_location : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.bankAccountDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bank_account_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankAccountDetails.create');
    }

    public function store(StoreBankAccountDetailRequest $request)
    {
        $bankAccountDetail = BankAccountDetail::create($request->all());

        return redirect()->route('admin.bank-account-details.index');
    }

    public function edit(BankAccountDetail $bankAccountDetail)
    {
        abort_if(Gate::denies('bank_account_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankAccountDetails.edit', compact('bankAccountDetail'));
    }

    public function update(UpdateBankAccountDetailRequest $request, BankAccountDetail $bankAccountDetail)
    {
        $bankAccountDetail->update($request->all());

        return redirect()->route('admin.bank-account-details.index');
    }

    public function show(BankAccountDetail $bankAccountDetail)
    {
        abort_if(Gate::denies('bank_account_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankAccountDetails.show', compact('bankAccountDetail'));
    }

    public function destroy(BankAccountDetail $bankAccountDetail)
    {
        abort_if(Gate::denies('bank_account_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccountDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankAccountDetailRequest $request)
    {
        $bankAccountDetails = BankAccountDetail::find(request('ids'));

        foreach ($bankAccountDetails as $bankAccountDetail) {
            $bankAccountDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
