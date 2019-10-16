@extends('adminlte::page')

@section('title', 'sales')

@section('content_header')
  <h1>Edit</h1>
@stop

@section('content_header')
  <div class="row">
    <div class="col-md-6">
      <h3>Edit Sales<h3>
    </div>
    <div class="col-md-6 text-right">
      <h3>
        <a type="button" class="btn btn-info" href="">

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
          <form action="{{ route('sales.update', $sales->id) }}" method="post" >
            @csrf
            @method('put')
            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <input type="text" class="form-control" name="name" value="{{$sales->name}}" id="example = budi"  aria-describedby="emailHelp" placeholder=" Nama">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">No Telepon</label>
              <input type="text" class="form-control" name="phone" value="{{$sales->phone}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No telp">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Email</label>
              <input type="text" class="form-control" name="email" value="{{$sales->email}}" id="exampleInputPassword1" placeholder="Email">
            </div>
            <fieldset class="form-group">
              <div class="row">
                <label class="col-form-label col-sm-2 pt-0">Gender</label>
                <div class="col-sm-10">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" {{($sales->gender == 'male')? 'checked':''}} id="gridRadios1" value="male">
                    <label class="form-check-label" for="gridRadios1">
                      Laki-laki
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" {{($sales->gender == 'female')? 'checked':''}} id="gridRadios2" value="female">
                    <label class="form-check-label" for="gridRadios2">
                      Perempuan
                    </label>
                  </div>
                </div>
              </div>
            </fieldset>
            <div class="form-group">
              <label for="exampleInputPassword1">Address</label>
              <input type="text" class="form-control" name="address" value="{{$sales->address}}" id="exampleInputPassword1" placeholder="alamat">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Patokan</label>
              <input type="text" class="form-control" name="patokan" value="{{$sales->patokan}}" id="exampleInputPassword1" placeholder="patokan">
            </div>
            <input type="text" value="{{$sales->status}}" name="status" id="status" hidden/>
            <button type="submit" class="btn btn-info">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
