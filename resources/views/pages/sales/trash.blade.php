@extends('adminlte::page')

@section('title', 'Customer')

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
        <h3>Trash</h3>
    </div>
    <div class="col-md-6 text-right">
        <h3>

            <a class="btn btn-info" href="{{route('sales')}}">

                Kembali
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
                    {data: 'status'},
                    {
                        data: 'id',
                        render: function(data){
                            const link ="{{route('sales.trash'  )}}"+"/"+data;
                            const restore = '<form role="form" action="'+link+'" style="margin: 0 3px;display:inline" method="POST">{{ csrf_field()}}{{method_field('put')}}<button class="btn btn-primary btn-xs">restore</button></form>';
                            const hapus = '<form role="form" action="'+link+'" style="margin: 0 3px;display:inline" method="POST">{{ csrf_field()}}{{method_field('delete')}}<button class="btn btn-danger btn-xs">delete</button></form>';
                            return '<div class="text-center">'+restore+hapus+'</div>';
                        }
                    }
                ]
            });
        });
    </script>

@stop
