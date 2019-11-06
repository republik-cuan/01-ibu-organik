@extends('adminlte::page')

@section('title', 'Rekap Barang')

@section('content_header')
    <h1>Rekap Barang</h1>
@stop

@section('content')
  <div class="box box-danger">
    <div class="box-body">
      <div class="row">
        <div class="col-md-6 col-md-offset-6 text-right">
          <a class="btn btn-success" href="{{route('rekap.export-item')}}" style="margin-bottom: 10px;">Cetak</a>
        </div>
        <div class="col-md-12">
          <form class="form-inline" action="" method="get">
            <div class="form-group">
              <label class="sr-only" for="start_date">Start Date</label>
              <input id="start_date" class="form-control" type="date" name="start_date">
            </div>
            <div class="form-group">
              <label class="sr-only" for="end_date">End Date</label>
              <input id="end_date" class="form-control" type="date" name="end_date">
            </div>
            <button type="submit" class="btn btn-info">Submit</button>
          </form>
          <table id="table-item" class="data-table table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Terjual</th>
                <th>Modal</th>
                <th>Total Harga</th>
                <th>Margin</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop


@section('js')
<script charset="utf-8">
  let subtotal = 0;
  let margin = 0;
  $(document).ready(function(){
    $('#table-item').dataTable({
      data: {!! $items !!},
      columns: [{
          data: 'id',
          render: function(data) {
            console.log(arguments);
            return arguments[3].row+=1;
          },
        },
        {
          data: 'name'
        },
        {
          data: 'sold',
        },
        {
          data: 'modal',
          render: function(data) {
            return `Rp. ${new Intl.NumberFormat().format(data)}`;
          }
        },
        {
          data: 'purchases',
          render: function(data) {
            let harga = 0;
            let hasil = 0;
            subtotal = 0;
            margin = 0;
            if (data.length > 0) {
             data.map((datum) => {
                switch(datum.statusHarga) {
                  case 'reseller':
                    harga = arguments[2].reseller;
                    break;
                  case 'end user':
                    harga = arguments[2].endUser;
                    break;
                  case 'modal':
                    harga = arguments[2].modal;
                    break;
                }
                subtotal += (harga * datum.pivot.total);
              });
            } else {
              subtotal = 0;
            }
            return `Rp. ${new Intl.NumberFormat().format(subtotal)}`;
          },
        },
        {
          data: 'purchases',
          render: function(data) {
            let harga = 0;
            let hasil = 0;
            if (data.length>0) {
              data.map((datum) => {
                margin += (arguments[2].modal * datum.pivot.total);
              });
            } else {
              margin = 0;
            }
            return `Rp. ${new Intl.NumberFormat().format(subtotal-margin)}`;
          },
        },
      ]
    });
  });
</script>
@endsection
