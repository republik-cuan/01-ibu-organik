@extends('adminlte::page')

@section('title', 'Tambah Sales')

@section('content_header')
<div class="row">
    <div class="col-md-6">
      <h3>Tambah Sales<h3>
    </div>
    <div class="col-md-6 text-right">
      <h3>
        <a type="button" class="btn btn-info" href="{{route('sales')}}">

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
          <form action="{{route('sales.store')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <input type="text" class="form-control" name="name" id="example = budi"  aria-describedby="emailHelp" placeholder="Nama">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">No Telepon</label>
              <input type="text" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="no telp">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Email</label>
              <input type="email" class="form-control" name="email" id="exampleInputPassword1" placeholder="Email">
            </div>
            <fieldset class="form-group">
              <div class="row">
                <label class="col-form-label col-sm-2 pt-0">Gender</label>
                <div class="col-sm-10">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male" checked>
                    <label class="form-check-label" for="gridRadios1">
                      Laki-laki
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female">
                    <label class="form-check-label" for="gridRadios2">
                      Perempuan
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
            <div class="form-group">
              <label for="exampleInputPassword1">Address</label>
              <input type="text" class="form-control" name="address" id="exampleInputPassword1" placeholder="alamat">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Patokan</label>
              <input type="text" class="form-control" name="patokan" id="exampleInputPassword1" placeholder="patokan">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Status</label>
                <select class="form-control" name="status" id="exampleFormControlSelect1">
                <option value="">--select status--</option>
                <option value="agen">Agen</option>
                <option value="distributor">Distributor</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
