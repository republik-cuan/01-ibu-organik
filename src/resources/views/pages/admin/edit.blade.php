@extends('adminlte::page')

@section('title', 'Edit Kelompok')

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h3>Edit Admin<h3>
    </div>
    <div class="col-md-6 text-right">
        <h3>
            <a type="button" class="btn btn-info" href="{{route('admin')}}">
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
              <form action="{{route('admin', $admin->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" placeholder="nama admin">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" placeholder="email admin">
                </div>
                <div class="form-group">
                  <label for="password">Kata Sandi</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="masukan password">
                </div>
                <button type="submit" class="btn btn-info">submit</button>
              </form>
            </div>
          </div>
        </div>
    </div>
@stop

