@extends('layouts.admin')
@section('content')
@can('industrial_experience_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.industrial-experiences.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.industrialExperience.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'IndustrialExperience', 'route' => 'admin.industrial-experiences.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.industrialExperience.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-IndustrialExperience">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.industrialExperience.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.industrialExperience.fields.user_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.industrialExperience.fields.work_experience') }}
                    </th>
                    <th>
                        {{ trans('cruds.industrialExperience.fields.designation') }}
                    </th>
                    <th>
                        {{ trans('cruds.industrialExperience.fields.from') }}
                    </th>
                    <th>
                        {{ trans('cruds.industrialExperience.fields.to') }}
                    </th>
                    <th>
                        {{ trans('cruds.industrialExperience.fields.work_type') }}
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
@can('industrial_experience_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.industrial-experiences.massDestroy') }}",
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
    ajax: "{{ route('admin.industrial-experiences.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_name_name', name: 'user_name.name' },
{ data: 'work_experience', name: 'work_experience' },
{ data: 'designation', name: 'designation' },
{ data: 'from', name: 'from' },
{ data: 'to', name: 'to' },
{ data: 'work_type', name: 'work_type' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-IndustrialExperience').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection