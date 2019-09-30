@extends('adminlte::page')

@section('title', 'Penjualan')

@section('content_header')
  <div class="row">
    <div class="col-md-6">
      <h3>Pembelian</h3>
    </div>
    <div class="col-md-6 text-right">
      <h3>
        <a class="btn btn-info" href="{{route('purchase.create')}}">
          Tambah Pembelian
        </a>
      </h3>
    </div>
  </div>
@stop



@section('content')
  <div class="box box-danger">
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <table id="data-table" class="data-table table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Bank</th>
                <th>No Rekening</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop

@section('js')
  <script>
    $(document).ready(function() {
      $('.data-table').dataTable({
        data: {!! $purchases !!},
        columns: [
          {
            data: 'id',
            render: function(data) {
              return arguments[3].row+=1;
            },
          },
          {data: 'kode'},
          {data: 'customer.name'},
          {data: 'customer.phone'},
          {
            data: 'bank',
            render: function(data) {
              return data.toUpperCase()
            }
          },
          {data: 'rekening'},
          {data: 'statusPembayaran'},
          {
            data: 'id',
            render: function(data){
              const link ="{{route('purchase')}}"+"/"+data;
              const hh = "/inventories/"+data;
              console.log(hh);
              const verified = '<form action="'+hh+'" style="margin: 0 3px; display: inline;" method="post">@csrf @method('put')<button class="btn btn-success btn-xs">verified</button></form>';
              const detail = '<a class="btn btn-info btn-xs" style="margin: 0 3px;" href="'+link+'/add">detail</a>';
              const edit = '<a class="btn btn-primary btn-xs" style="margin: 0 3px" href="'+link+'">edit</a>';
              const hapus = '<form role="form" action="'+link+'" style="margin: 0 3px;display:inline" method="POST">{{ csrf_field()}}{{method_field('delete')}}<button class="btn btn-danger btn-xs">delete</button></form>';
              return '<div class="text-center">'+verified+detail+edit+hapus+'</div>';
            }
          }
        ]
      });
    });
  </script>
@stop
