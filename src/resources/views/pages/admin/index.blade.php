@extends('adminlte::page')
@section('title', 'Admin')

@section('content_header')
<div class="row">
  <div class="col-md-6">
    <h3>Admin</h3>
  </div>
  <div class="col-md-6 text-right">
    <h3>
      <a class="btn btn-info" href="{{route('admin.create')}}">Tambah Admin</a>
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
              <th>Nama</th>
              <th>Email</th>
              <th>Actions</th>
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
  console.log({!! $admins !!})
  $(document).ready(function() {
    $('.data-table').dataTable({
      data: {!! $admins !!},
      columns: [{
          data: 'id'
        },
        {
          data: 'name'
        },
        {
          data: 'email'
        },
        {
          data: 'id',
          render: function(data) {
            const link = "{{route('admin')}}"+"/"+data;
            const detail = '<a class="btn btn-primary btn-xs" stlye="margin: 0 3px" href="' + link + ' ">edit</a>';
            const hapus = '<form role="form" style="margin: 0 3px; display: inline;" action="' + link + '"method="POST">@csrf @method("DELETE")<button class="btn btn-danger btn-xs">delete</button></form>';
            return '<div>' + detail + hapus + '</div>';
          }
        },
      ]
    });
  });
</script>
@stop
