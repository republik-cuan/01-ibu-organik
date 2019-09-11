@extends('adminlte::page')

@section('title', 'customer')

@section('content_header')
  <h1>Edit</h1>
@stop

@section('content_header')
  <div class="row">
    <div class="col-md-6">
      <h3>Edit Customer<h3>
    </div>
    <div class="col-md-6 text-right">
      <h3>
        <a type="button" class="btn btn-info" href="{{route('customer')}}">

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
          <form action="{{ route('customer.update', $customer->id) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <input type="text" class="form-control" name="name" value="{{$customer->name}}" id="example = budi"  aria-describedby="emailHelp" placeholder=" Nama">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">No Telepon</label>
              <input type="text" class="form-control" name="phone" value="{{$customer->phone}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No telp">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Email</label>
              <input type="text" class="form-control" name="email" value="{{$customer->email}}" id="exampleInputPassword1" placeholder="Email">
            </div>
            <fieldset class="form-group">
              <div class="row">
                <label class="col-form-label col-sm-2 pt-0">Gender</label>
                <div class="col-sm-10">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="{{$customer->gender}}" id="gridRadios1" value="male" checked>
                    <label class="form-check-label" for="gridRadios1">
                      Laki-laki
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="{{$customer->gender}}" id="gridRadios2" value="female">
                    <label class="form-check-label" for="gridRadios2">
                      Perempuan
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
            <div class="form-group">
              <label for="exampleInputPassword1">Address</label>
              <input type="text" class="form-control" name="adress" value="{{$customer->address}}" id="exampleInputPassword1" placeholder="alamat">
            </div>
            <button type="submit" class="btn btn-info">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
