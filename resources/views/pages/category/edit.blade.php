@extends('adminlte::page')

@section('title', 'Edit Category')

@section('content_header')
<div class="row">
  <div class="col-md-6">
    <h3>Edit Category<h3>
  </div>
  <div class="col-md-6 text-right">
    <h3>
      <a type="button" class="btn btn-info" href="{{route('category')}}">

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
      <div class="col-md-6">
        <form action="{{ route('category.update', $category->id) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('put') }}
          <div class="form-group">
            <label for="namaKelompok">Category</label>
            <input type="text" class="form-control" name="name" value="{{$category->name}}" placeholder="Nama Category" autofocus>
          </div>
          <button type="submit" class="btn btn-info">submit</button>
        </form>
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
  console.log('Hi!');
</script>
@stop
