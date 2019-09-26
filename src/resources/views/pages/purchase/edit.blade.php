@extends('adminlte::page')

@section('title', 'Edit Pembelian')

@section('content_header')
  <div class="row">
    <div class="col-md-6">
      <h3>Edit Pembelian<h3>
    </div>
    <div class="col-md-6 text-right">
      <h3>
        <a type="button" class="btn btn-info" href="{{route('purchase')}}">

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
          <form action="{{ route('purchase.update', $purchase->id) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
              <label for="kode">Kode</label>
              <input type="text" class="form-control" name="kode" value="{{$purchase->kode}}" id="kode" readonly>
            </div>
            <div class="form-group">
              <label for="customer">Nama Pelanggan</label>
              <input type="text" class="form-control" name="customer" value="{{$purchase->customer->name}}" id="customer" readonly>
            </div>
            <div class="form-group">
              <label for="phone">Telephone Pelanggan</label>
              <input type="text" class="form-control" name="phone" value="{{$purchase->customer->phone}}" id="phone" readonly>
            </div>
            <div class="form-group">
              <label for="statusPembayaran">Status Pembayaran</label>
              <select class="form-control" name="statusPembayaran" id="statusPembayaran">
                @foreach ($purchase->statusPembayaran as $stat)
                  <option value="{{$stat}}" {{$purchase['statusPembayaran']==$stat ? 'selected' : ''}}>
                    {{ucwords($stat)}}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="pembayaran">Tanggal Pembayaran</label>
              <input type="date" class="form-control" name="pembayaran" value="{{$purchase->pembayaran}}" id="pembayaran" style="line-height: normal;" required>
            </div>
            <div class="form-group">
              <label for="deliveryOption">Opsi Pengiriman</label>
              <select id="deliveryOption" class="form-control" name="deliveryOption">
                @foreach ($purchase->deliveries as $delivery)
                  <option value="{{$delivery}}" {{$purchase->deliveryOption==$delivery ? 'selected' : ''}}>
                    {{ucwords($delivery)}}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="deliveryPrice">Ongkos Kirim</label>
              <input class="form-control" type="number" value="{{$purchase->deliveryPrice}}" required>
            </div>
            <button type="submit" class="btn btn-info">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop

