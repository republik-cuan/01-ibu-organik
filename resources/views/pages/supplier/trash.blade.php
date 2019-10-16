@extends('adminlte::page')

@section('title', 'Supplier')

@section('content_header')
  <div class="row">
    <div class="col-md-6">
      <h3>Supplier</h3>
    </div>
    <div class="col-md-6 text-right">
      <h3>
        <a class="btn btn-info" href="{{route('supplier')}}">Kembali</a>
      </h3>
    </div>
  </div>
@stop

@section('content')
  <div class="box box-danger">
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <table class="data-table table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>No.Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
  $(document).ready(function () {
    $('.data-table').dataTable({
      data: {!! $suppliers !!},
      columns: [
        {
          data: 'id',
          render: function(data) {
            return arguments[3].row+1;
          },
        },
        {data: 'name'},
        {data: 'phone'},
        {data: 'address'},
        {
          data: 'id',
          render: function(data){
            const link ="{{route('supplier.trash')}}"+"/"+data;
            const restore = '<form role="form" action="' + link + '" style="margin: 0 3px;display:inline" method="POST">@csrf @method("put")<button class="btn btn-primary btn-xs">restore</button></form>';
            const hapus = '<form role="form" action="'+link+'" style="margin: 0 3px;display:inline" method="POST">{{ csrf_field()}}{{method_field('delete')}}<button class="btn btn-danger btn-xs">delete</button></form>';
            return '<div class="text-center">'+restore+hapus+'</div>';
          }
        },
      ],
    });
  });
</script>
@stop
