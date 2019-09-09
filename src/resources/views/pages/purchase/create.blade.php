@extends('adminlte::page')

@section('title', 'Tambah Penjualan')

@section('content_header')
  <div class="row">
    <div class="col-md-6">
      <h3>Buat Penjualan</h3>
    </div>
    <div class="col-md-6 text-right">
      <h3>
        <a class="btn btn-info" href="{{route('purchase')}}">
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
        <div class="col-md-5">
          @if (session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif
          <form action="{{ route('purchase.store') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="customer">Pelanggan</label>
              <select name="customer" id="customer" class="form-control" required>
                <option value="">Pilih</option>
                @foreach ($customers as $customer) 
                  <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->email }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="bank">Bank</label>
              <select name="bank" id="bank" class="form-control" required>
                <option>Pilih</option>
                @foreach ($banks as $bank) 
                  <option value="{{$bank}}">{{$bank}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="accountNumber">No Rekening</label>
              <input class="form-control" type="text" name="accountNumber" id="accountNumber" placeholder="nomor rekening 11xxx" required>
            </div>
            <div class="form-group">
              <label for="discount">Discount</label>
              <input class="form-control" type="number" min="0" name="discount" id="discount" placeholder="0 ~ 100%" required>
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-sm" type="submit">Tambah</button>
              <button class="btn btn-warning btn-sm" type="reset">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
