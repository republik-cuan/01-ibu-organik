@extends('adminlte::page')

@section('title', 'Tambah Bank')

@section('content_header')
<div class="row">
  <div class="col-md-6">
    <h3>Tambah Bank<h3>
  </div>
  <div class="col-md-6 text-right">
    <h3>
      <a type="button" class="btn btn-info" href="{{route('bank')}}">
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
        <form action="{{route ('bank.store')}}" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="namaBank">Nama Bank</label>
            <input type="text" class="form-control" name="bank" id="namaBank" placeholder="Nama bank" autofocus>
            {!! $errors->first('bank', '<p calss="help-block text-danger">:message</p>')!!}
          </div>
          <div class="form-group">
            <label for="rekening">Nomor Rekening</label>
            <input type="text" class="form-control" name="rekening" id="rekening" placeholder="Nomor rekening" autofocus>
            {!! $errors->first('rekening', '<p calss="help-block text-danger">:message</p>')!!}
          </div>
          <button type="submit" class="btn btn-info">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
