@extends('adminlte::page')

@section('title', 'Sales')

@section('content_header')

  @if(session()->get('message'))
    <div class="row">
      <div class="col-md-6">
        <div class="alert alert-success">
          {{session()->get('message')}}
        </div>
      </div>
    </div>
  @endif


  <div class="row">
    <div class="col-md-6">
      <h3>Sales</h3>
    </div>
    <div class="col-md-6 text-right">
      <h3>
        <a class="btn btn-warning" href="{{route('sales.trash')}}">
          Sampah
        </a>
        <a class="btn btn-info" href="{{route('sales.create')}}">
          Tambah Sales
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
                <th>Nama</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Patokan</th>
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
        data: {!! $saless !!},
        columns: [
          {
            data: 'id',
            render: function(data) {
              return arguments[3].row+=1;
            },
          },
          {data: 'name'},
          {data: 'phone'},
          {data: 'email'},
          {data: 'gender'},
          {data: 'address'},
          {data: 'patokan'},
          {
            data: 'id',
            render: function(data){
              const link ="{{route('sales')}}"+"/"+data;
              const detail = '<a class="btn btn-primary btn-xs" stlye="margin: 0 3px" href="'+link+'">edit</a>';
              const hapus = '<form role="form" action="'+link+'" style="margin: 0 3px;display:inline" method="POST">{{ csrf_field()}}{{method_field('delete')}}<button class="btn btn-danger btn-xs">delete</button></form>';
              return '<div class="text-center">'+detail+hapus+'</div>';
            }
          }
        ]
      });
    });
  </script>
@stop
