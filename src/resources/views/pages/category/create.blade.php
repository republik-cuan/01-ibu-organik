@extends('adminlte::page')

@section('title', 'Tambah Kelompok')

@section('content_header')
<div class="row">
  <div class="col-md-6">
    <h3>Tambah Category<h3>
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
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <form action="" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="namaSuppliers">Nama</label>
              <input type="text" class="form-control" name="name" placeholder="nama suppliers">
            </div>
            <div class="form-group">
              <label for="noTelephone">No. Telephone</label>
              <input type="text" class="form-control" name="suppliers" placeholder="nomor telephone">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" name="address" placeholder="nomor telephone">
            </div>
            <button type="submit" class="btn btn-info">submit</button>
          </form>
        </div>
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