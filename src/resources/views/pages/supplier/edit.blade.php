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
          <form action="{{route('supplier.update', $supplier->id)}}" method="post">
            @csrf
            {{method_field('put')}}
            <div class="form-group">
              <label for="namaSupplier">Nama</label>
              <input type="text" class="form-control" id="namaSupplier" name="name" value="{{$supplier->name}}">
              {!! $errors->first('name', '<p calss="help-block text-danger">:message</p>')!!}
            </div>
            <div class="form-group">
              <label for="phoneNumber">No.Telepon</label>
              <input type="text" class="form-control" id="phoneNumber" name="phone" value="{{$supplier->phone}}">
              {!! $errors->first('phone', '<p calss="help-block text-danger">:message</p>')!!}
            </div>
            <div class="form-group">
              <label for="address">Alamat</label>
              <input type="text" class="form-control" id="address" name="address" value="{{$supplier->address}}">
              {!! $errors->first('address', '<p calss="help-block text-danger">:message</p>')!!}
            </div>
            <button type="submit" class="btn btn-info">submit</button>
          </form>
          </ div>
        </div>
      </div>
    </div>
  @stop
