@extends('adminlte::page')

@section('title', 'Rekap')

@section('content_header')
    <h1>Rekap</h1>
@stop

@section('content')
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#tab-01" data-toggle="tab">Barang</a>
      </li>
      <li>
        <a href="#tab-02" data-toggle="tab">Bulanan</a>
      </li>
    </ul>
    <div class="tab-content">
      <div id="tab-01" class="tab-pane active">
        <div class="row">
          <div class="col-md-6 col-md-offset-6 text-right">
            <a class="btn btn-success" href="{{route('rekap.export-item')}}" style="margin-bottom: 10px;">Cetak</a>
          </div>
          <div class="col-md-12">
            <table id="table-item" class="data-table table table-bordered table-hover text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Terjual</th>
                  <th>Harga Modal</th>
                  <th>Total Bayar</th>
                  <th>Margin</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div id="tab-02" class="tab-pane">
        <div class="row">
          <div class="col-md-6 col-md-offset-6 text-right">
            <a class="btn btn-success" href="{{route('admin')}}" style="margin-bottom: 10px;">Cetak</a>
          </div>
          <div class="col-md-12">
            <table id="table-item" class="data-table table table-bordered table-hover text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Bulan</th>
                  <th>Total Bayar</th>
                </tr>
              </thead>
            </table>
          </div>
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
            if (data.length>1) {
              data.map((datum) => {
                margin += (arguments[2].modal * datum.pivot.total);
              });
            } else {
              margin = 0;
            }
            return `Rp. ${new Intl.NumberFormat().format(margin)}`;
          },
        },
      ]
    });
  });
</script>
<script charset="utf-8">
  $(document).ready(function(){
    $('#table-month').dataTable({
      data: {!! $purchases !!},
      columns: [
        { 
          data: 'id',
          render: function(data){
            console.log('hello')
            return arguments[3].row+=1;
          },
        },
        {
          data: 'created_at',
          render: function(data){
            const month = new Date(data);
            return month;
          },
        },
        {
          data: 'inventories',
          render: function(data){
            data.map(datum => {
              switch(arguments[2].statusHarga){
                case 'reseller':
                  harga = datum.item.reseller;
                  break;
                case 'modal':
                  harga = datum.item.modal;
                  break;
                case 'end user':
                  harga = datum.item.endUser;
                  break;
              }
              hasil += ((harga-datum.item.modal)*datum.total);
            });
            return `Rp. ${new Intl.NumberFormat().format(hasil)}`;
          },
        }
      ],
    })
  })
</script>
@endsection
