@can('donor_fund_raiser_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.donor-fund-raisers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.donorFundRaiser.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.donorFundRaiser.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-fundraiserDonorFundRaisers">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.donorFundRaiser.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.donorFundRaiser.fields.fundraiser') }}
                        </th>
                        <th>
                            {{ trans('cruds.donorFundRaiser.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.donorFundRaiser.fields.caption') }}
                        </th>
                        <th>
                            {{ trans('cruds.donorFundRaiser.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donorFundRaisers as $key => $donorFundRaiser)
                        <tr data-entry-id="{{ $donorFundRaiser->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $donorFundRaiser->id ?? '' }}
                            </td>
                            <td>
                                {{ $donorFundRaiser->fundraiser->caption ?? '' }}
                            </td>
                            <td>
                                {{ $donorFundRaiser->amount ?? '' }}
                            </td>
                            <td>
                                {{ $donorFundRaiser->caption ?? '' }}
                            </td>
                            <td>
                                {{ $donorFundRaiser->user->name ?? '' }}
                            </td>
                            <td>
                                @can('donor_fund_raiser_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.donor-fund-raisers.show', $donorFundRaiser->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('donor_fund_raiser_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.donor-fund-raisers.edit', $donorFundRaiser->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('donor_fund_raiser_delete')
                                    <form action="{{ route('admin.donor-fund-raisers.destroy', $donorFundRaiser->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('donor_fund_raiser_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.donor-fund-raisers.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-fundraiserDonorFundRaisers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection