@extends('adminlte::page')

@section('title', 'Edit Nama')

@section('content_header')
  <div class="row">
    <div class="col-md-6">
      <h3>Edit Nama<h3>
    </div>
    <div class="col-md-6 text-right">
      <h3>
        <a type="button" class="btn btn-info" href="{{route('supplier')}}">

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
          <form action="" method="post">
            @csrf
            <div class="form-group">
              <label for="namaSupplier">Nama</label>
              <input type="text" class="form-control" id="namaSupplier" name="name" placeholder="nama supplier">
            </div>
            <div class="form-group">
              <label for="phoneNumber">No.Telepon</label>
              <input type="text" class="form-control" id="phoneNumber" name="phone" placeholder="nomer telepon">
            </div>
            <div class="form-group">
              <label for="address">Alamat</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="alamat">
            </div>
            <button type="submit" class="btn btn-info">submit</button>
          </form>
          </ div>
        </div>
      </div>
    </div>
  @stop
