@extends('adminlte::page')
@section('title', 'Admin')

@section('content_header')
  @if (session()->get('message'))
    <div class="row">
      <div class="col-md-6">
        <div class="alert alert-success alert-dismissable" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          {{strtoupper(session()->get('message'))}}
        </div>
      </div>
    </div>
  @endif
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
      columns: [
        {
          data: 'id',
          render: function(data) {
            return arguments[3].row+=1;
          },
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
            const detail = '<a class="btn btn-primary btn-xs" stlye="margin: 0 3px" href="' + link + ' ">Edit</a>';
            const hapus = '<form role="form" style="margin: 0 3px; display: inline;" action="' + link + '"method="POST">@csrf @method("DELETE")<button class="btn btn-danger btn-xs">Delete</button></form>';
            return '<div>' + detail + hapus + '</div>';
          }
        },
      ]
    });
  });
</script>
@stop
