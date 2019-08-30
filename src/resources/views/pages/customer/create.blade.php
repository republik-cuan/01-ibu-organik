@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>Tambah Customer</h1>
@stop

@section('content')
<div class="edit box box-danger">
    <div class="box-body row">
    <form class="col-md-6" action="{{ url('customer/') }}" method="POST">
            <form action="{{route('customer.store')}}" method="post">
                    {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" class="form-control" name="name" id="example = budi"  aria-describedby="emailHelp" placeholder="Enter Nama">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">No Telepon</label>
            <input type="text" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="text" class="form-control" name="email" id="exampleInputPassword1" placeholder="Password">
        </div>
        <fieldset class="form-group">
            <div class="row">
              <label class="col-form-label col-sm-2 pt-0">Gender</label>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="laki-laki" checked>
                  <label class="form-check-label" for="gridRadios1">
                    Laki-laki
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="perempuan">
                  <label class="form-check-label" for="gridRadios2">
                    Perempuan
                  </label>
                </div>
              </div>
            </div>
          </fieldset>

        <div class="form-group">
            <label for="exampleInputPassword1">Address</label>
            <input type="password" class="form-control" name="gender" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>
@stop
