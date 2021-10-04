@extends('layouts.admin')
@section('content')
@can('owner_fund_raiser_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.owner-fund-raisers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.ownerFundRaiser.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.ownerFundRaiser.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-OwnerFundRaiser">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.ownerFundRaiser.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.ownerFundRaiser.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.ownerFundRaiser.fields.caption') }}
                    </th>
                    <th>
                        {{ trans('cruds.ownerFundRaiser.fields.photo') }}
                    </th>
                    <th>
                        {{ trans('cruds.ownerFundRaiser.fields.fund') }}
                    </th>
                    <th>
                        {{ trans('cruds.ownerFundRaiser.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.ownerFundRaiser.fields.days') }}
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
@can('owner_fund_raiser_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.owner-fund-raisers.massDestroy') }}",
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
    ajax: "{{ route('admin.owner-fund-raisers.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_name', name: 'user.name' },
{ data: 'caption', name: 'caption' },
{ data: 'photo', name: 'photo', sortable: false, searchable: false },
{ data: 'fund', name: 'fund' },
{ data: 'status', name: 'status' },
{ data: 'days', name: 'days' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-OwnerFundRaiser').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection