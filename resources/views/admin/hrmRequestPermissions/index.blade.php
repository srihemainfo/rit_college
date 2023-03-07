@extends('layouts.admin')
@section('content')
@can('hrm_request_permission_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.hrm-request-permissions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.hrmRequestPermission.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'HrmRequestPermission', 'route' => 'admin.hrm-request-permissions.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.hrmRequestPermission.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-HrmRequestPermission">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.hrmRequestPermission.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.hrmRequestPermission.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email_verified_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.remember_token') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.two_factor') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.two_factor_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.two_factor_expires_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.hrmRequestPermission.fields.no_of_hours') }}
                    </th>
                    <th>
                        {{ trans('cruds.hrmRequestPermission.fields.from_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.hrmRequestPermission.fields.reason') }}
                    </th>
                    <th>
                        {{ trans('cruds.hrmRequestPermission.fields.approved_by') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('hrm_request_permission_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hrm-request-permissions.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.hrm-request-permissions.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_name', name: 'user.name' },
{ data: 'user.email', name: 'user.email' },
{ data: 'user.email_verified_at', name: 'user.email_verified_at' },
{ data: 'user.remember_token', name: 'user.remember_token' },
{ data: 'user.two_factor', name: 'user.two_factor' },
{ data: 'user.two_factor_code', name: 'user.two_factor_code' },
{ data: 'user.two_factor_expires_at', name: 'user.two_factor_expires_at' },
{ data: 'no_of_hours', name: 'no_of_hours' },
{ data: 'from_date', name: 'from_date' },
{ data: 'reason', name: 'reason' },
{ data: 'approved_by', name: 'approved_by' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-HrmRequestPermission').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection