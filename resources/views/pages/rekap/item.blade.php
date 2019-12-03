@extends('adminlte::page')

@section('title', 'Rekap Barang')

@section('content_header')
    <h1>Rekap Barang</h1>
@stop

@section('content')
  <div class="box box-danger">
    <div class="box-body">
      <div class="row">
        <div class="col-6 col-md-6">
          <form class="form-inline" action="" method="get">
            <div class="form-group">
              <label class="sr-only" for="start_date">Start Date</label>
              <input id="start_date" class="form-control" type="date" name="start_date" value="{{ $start }}">
            </div>
            <div class="form-group">
              <label class="sr-only" for="end_date">End Date</label>
              <input id="end_date" class="form-control" type="date" name="end_date" value="{{ $end }}">
            </div>
            <div class="form-group">
              <label class="sr-only" for="bank">Bank</label>
              <select class="form-control" name="bank" id="bank">
                <option value="none">--Pilh--</option>
                @foreach ($banks as $bank)
                  <option value="{{ $bank['id'] }}" {{ $bnk==$bank['id'] ? 'selected' : ''}}>
                    {{ $bank['bank'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-info">Filter</button>
          </form>
        </div>
        <div class="col-6 col-md-6 text-right">
					<form action="" method="post">
						@csrf
						<button type="submit" class="btn btn-success" target="__blank">
							Cetak
						</button>
					</form>
        </div>
        <div class="col-md-12">
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
            return arguments[3].row+=1;
          },
        },
        {
          data: 'name'
        },
        {
          data: 'purchases',
          render: function(data) {
            let arr = [];
            let hasil = 0;
            if (typeof(data)=="object") {
              arr = $.map(data, (val, id) => val.pivot.total)
            } else {
              arr = data
            }


            hasil = arr.length > 0
                      ?  arr.reduce((acc, cur) => acc + cur)
                      : 0
            return hasil
          },
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
            let arr = [];
            subtotal = 0;
            margin = 0;
            if (typeof(data)=="object") {
              arr = $.map(data, function(val, id) { return [val]; })
            } else {
              arr = data
            }
            if (arr.length > 0) {
             arr.map((datum) => {
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
