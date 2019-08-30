@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h3>Customer</h3>
    </div>
    <div class="col-md-6 text-right">
        <h3>
            <a class="btn btn-info" href="{{route('customer.create')}}">

                Tambah Customer
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
                    <table class="data-table table table-bordered table-hover">
                        <thead>
                            <tr>
                                {{-- <th class="text-center">No</th> --}}
                                <th class="text-center">Nama</th>
                                <th class="text-center">No HP</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Alamat</th>
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
       // {{--  console.log({!! $customer !!}) --}}
        $(document).ready(function () {
            $('.data-table').dataTable({
                data: {!! $customers!!},
                columns: [
                    {data: 'name'},
                    {data: 'phone'},
                    {data: 'email'},
                    {data: 'gender'},
                    {data: 'address'},
                    {
                        data: 'id',
                        render: function(data){
                            const link ="{{route('admin')}}"+"/"+data;
                            const detail = '<a class="btn btn-primary btn-xs" stlye="margin: 0 3px" href="'+link+'">edit</a>';
                            const hapus = '<form role="form" action="'+link+'" stlye="margin: 0 3px;display:inline" method="POST">{{ csrf_field()}}{{method_field('delete')}}<button class="btn btn-danger btn-xs">delete</button></form>';
                            return '<div class="text-center">'+detail+hapus+'</div>';
                        }
                    },
                ],
            });
        });
    </script>
@stop
