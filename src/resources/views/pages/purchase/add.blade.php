@extends('adminlte::page')

@section('title', 'Ubah Penjualan')

@section('content_header')
  <div class="row">
    <div class="col-md-6">
      <h3>Tambah Item Pembelian</h3>
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
        <div class="col-md-3">
          <div class="form-horizontal">
            <label class="col-md-5 control-label" style="text-align: left;">Nama</label>
            <div class="col-md-7">
              <p class="form-control-static">{{$customer->name}}</p>
            </div>
            <label class="col-md-5 control-label" style="text-align: left;">Telephone</label>
            <div class="col-md-7">
              <p class="form-control-static">{{$customer->phone}}</p>
            </div>
            <label class="col-md-5 control-label" style="text-align: left;">Alamat</label>
            <div class="col-md-7">
              <p class="form-control-static">{{$customer->address}}</p>
            </div>
            <label class="col-md-5 control-label" style="text-align: left;">Patokan</label>
            <div class="col-md-7">
              <p class="form-control-static">{{$customer->patokan}}</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-md-offset-6">
          <div class="form-horizontal">
            <label class="col-md-5 control-label">Kode</label>
            <div class="col-md-7">
              <p class="form-control-static">{{$purchase->kode}}</p>
            </div>
            <label class="col-md-5 control-label">Metode Pembayaran</label>
            <div class="col-md-7">
              <p class="form-control-static">{{strtoupper($purchase->bank)}}</p>
            </div>
            <label class="col-md-5 control-label">Status Harga</label>
            <div class="col-md-7">
              <p class="form-control-static">{{strtoupper($purchase['statusHarga'])}}</p>
            </div>
            <label class="col-md-5 control-label">Pengiriman Barang</label>
            <div class="col-md-7">
              <p class="form-control-static">
                {{strtoupper($purchase->deliveryOption)}} | {{"Rp. ".number_format($purchase->deliveryPrice,2)}}
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <table class="data-table table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Discount</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Sub Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                $harga = 0;
                $subTotal = 0;
                $totalItem = 0;
                $discount = 0;
                $total = 0;
              @endphp
              @foreach ($inventories as $key => $item)
                <tr>
                  <td>{{$key+=1}}</td>
                  <td>{{$item->item->name}}</td>
                  <td>
                    @php
                      $discount += $item->discount;
                      echo sprintf("%02s", $item->discount)." %";
                    @endphp
                  </td>
                  <td>
                    @php
                      $totalItem += $item->total;
                      echo $item->total." gram";
                    @endphp
                  </td>
                  <td>
                    @php
                      switch ($purchase['statusHarga']) {
                        case 'reseller' : 
                          $harga = $item->item->reseller * (100 - ($item->discount/100));
                          break;
                        case 'modal' :
                          $harga = $item->item->modal * (100 - ($item->discount/100));
                          break;
                        case 'end user' :
                          $harga = $item->item->endUser * (100 - ($item->discount/100));
                          break;
                      }
                      echo "Rp. ".number_format($harga, 2);
                    @endphp
                  </td>
                  <td>
                    @php
                      $temp = $harga * $item->total;
                      $subTotal += $temp;
                      echo "Rp. ".number_format($temp, 2);
                    @endphp
                  </td>
                  <td>
                    <form action="{{route('inventories.destroy', $item->id)}}" method="post">
                      @csrf
                      @method('delete')
                      <button class="btn btn-danger btn-xs">hapus</button>
                    </form>
                  </td>
                </tr>
              @endforeach
              <form action="{{route('inventories.store')}}" method="post">
                @csrf
                <tr>
                  <td><input type="number" name="purchase" id="purchase" value="{{$purchase->id}}" hidden></td>
                  <td>
                    <select class="js-example-basic-single form-control" name="item" id="item" required>
                      <option>Pilih</option>
                      @foreach ($items as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input class="form-control" type="number" min="0" placeholder="Discount" name="discount" id="discount" required/>
                  </td>
                  <td>
                    <input class="form-control" type="number" min="0" placeholder="Jumlah" name="total" id="total" required/>
                  </td>
                  <td colspan="3">
                    <button class="btn btn-primary" type="submit">
                      Submit
                    </button>
                  </td>
                </tr>
              </form>
            </tbody>
          </table>
        </div>
        <div class="col-md-3 col-md-offset-9">
          <table class="data-table table table-bordered table-hover text-center">
            <tr>
              <th>Total Harga</th>
              <td>
                @php
                  $hasil = $subTotal + $purchase->deliveryPrice;
                  echo "Rp. ".number_format($hasil, 2);
                @endphp
              </td>
            </tr>
            <tr>
              <th>Discount</th>
              <td>{{$discount." %"}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  <script charset="utf-8">
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
  </script>
@stop
