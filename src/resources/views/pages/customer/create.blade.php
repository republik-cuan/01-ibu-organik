@extends('adminlte::page')

@section('title', 'Tambah Customer')

@section('content_header')
<div class="row">
    <div class="col-md-6">
      <h3>Tambah Customer<h3>
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
<div class="edit box box-danger">
    <div class="box-body row">
   {{-- <form class="col-md-6" action="{{ url('customer') }}" method="POST"> --}}
            <form action="{{route('customer')}}" method="post">
                    {{ csrf_field() }}
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
            <input type="text" class="form-control" name="email" id="exampleInputPassword1" placeholder="Password">
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


          {{-- <div class="form-group">
            <label for="exampleFormControlSelect1">Jenis Kelamin</label>
            <select name="gender" class="form-control" id="exampleFormControlSelect1">
                <option>-----</option>
              <option value="male">Laki-Laki</option>
              <option value="female">Perempuan</option>

            </select>
          </div> --}}

          {{-- <fieldset
          div class="form-group col-md-4">
              <label for="inputState">Gender</label>
              <select id="inputState" name="gender" class="form-control">
                  <option  value="male" id="nilai1"selected>Laki-Laki</option >
                    <option  value="female" id="nilai1" selected>Perempuan</option >
                    </select>
                </div>
            </fieldset> --}}

        <div class="form-group">
            <label for="exampleInputPassword1">Address</label>
            <input type="text" class="form-control" name="adress" id="exampleInputPassword1" placeholder="alamat">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>
@stop
