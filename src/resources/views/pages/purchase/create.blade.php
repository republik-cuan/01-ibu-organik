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
              <select name="customer" id="customer" class="form-control js-example-basic-single" required>
                <option value="">Pilih</option>
                @foreach ($customers as $customer) 
                  <option value="{{ $customer->id }}">
                    {{ $customer->name }} - {{ $customer->phone }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="bank">Metode Pembayaran</label>
              <select name="bank" id="bank" class="form-control" required>
                <option>Pilih</option>
                @foreach ($banks as $bank) 
                  <option value="{{$bank}}">{{strtoupper($bank)}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="statusHarga">Status Harga</label>
              <select name="statusHarga" id="statusHarga" class="form-control" required>
                <option>Pilih</option>
                @foreach ($statusHarga as $harga) 
                    <option value="{{$harga}}">{{strtoupper($harga)}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="rekening">No Rekening</label>
              <input class="form-control" type="text" name="rekening" id="rekening" placeholder="nomor rekening 11xxx" required>
            </div>
            <div class="form-group">
              <label for="deliveryOption">Opsi Pengiriman</label>
              <select class="form-control" name="deliveryOption" id="deliveryOption" required>
                <option>Pilih</option>
                @foreach ($deliveries as $delivery)
                  <option value="{{$delivery}}">{{strtoupper($delivery)}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="deliveryPrice">Biaya Pengiriman</label>
              <input class="form-control" type="number" name="deliveryPrice" id="deliveryPrice" min="0" placeholder="xxx.xxx" required/>
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

@section('js')
  <script charset="utf-8">
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
  </script>
@stop
