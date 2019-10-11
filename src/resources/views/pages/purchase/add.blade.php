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
        <a class="btn btn-success" href="{{route('inventories.print', $purchase->id)}}">
          Cetak
        </a>
      </h3>
    </div>
  </div>
@stop

@section('content')
  <div class="box box-danger">
    <div class="box-body">
      <div class="row">
        <div class="col-md-4 col-sm-12">
          <div class="form-horizontal">
            <label class="col-md-5 control-label" style="text-align: left;">No Invoice</label>
            <div class="col-md-7">
              <p class="form-control-static">{{$purchase->kode}}</p>
            </div>
            <label class="col-md-5 control-label" style="text-align: left;">Nama</label>
            <div class="col-md-7">
              <p class="form-control-static">{{ucwords($customer->name)}}</p>
            </div>
            <label class="col-md-5 control-label" style="text-align: left;">Alamat</label>
            <div class="col-md-7">
              <p class="form-control-static">{{$customer->address}}</p>
            </div>
            <label class="col-md-5 control-label" style="text-align: left;">Telp</label>
            <div class="col-md-7">
              <p class="form-control-static">{{$customer->phone}}</p>
            </div>
            <label class="col-md-5 control-label" style="text-align: left;">Delivery By</label>
            <div class="col-md-7">
              <p class="form-control-static">{{strtoupper($purchase->deliveryOption)}}</p>
            </div>
            <label class="col-md-5 control-label" style="text-align: left;">Date</label>
            <div class="col-md-7">
              <p class="form-control-static">{{date_format($purchase->created_at, "d M Y")}}</p>
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
                $berat = 0;
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
                      echo "Rp. ".number_format($item->discount, 2);
                    @endphp
                  </td>
                  <td>
                    @php
                      $berat += $item->total;
                      echo $item->total." gram";
                    @endphp
                  </td>
                  <td>
                    @php
                      switch ($purchase['statusHarga']) {
                        case 'reseller' : 
                          $harga = $item->item->reseller;
                          break;
                        case 'modal' :
                          $harga = $item->item->modal;
                          break;
                        case 'end user' :
                          $harga = $item->item->endUser;
                          break;
                      }
                      echo "Rp. ".number_format($harga, 2);
                    @endphp
                  </td>
                  <td>
                    @php
                      $temp = $item->total * $harga;
                      $temp -= $item->discount;
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
                        @php
                          switch ($purchase['statusHarga']) {
                            case 'reseller' : 
                              $hrg = $item->reseller;
                              break;
                            case 'modal' :
                              $hrg = $item->modal;
                              break;
                            case 'end user' :
                              $hrg = $item->endUser;
                              break;
                          }
                        @endphp
                        <option value="{{$item->id}}">
                        {{$item->name." | Rp. ".number_format($hrg)}}
                        </option>
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
              <tr>
                <th colspan="2" style="text-align: right;">Total</th>
                <td></td>
                <td>{{number_format($berat, 2)}}</td>
                <td></td>
                <td colspan="2">{{"Rp. ".number_format($subTotal,2)}}</td>
              </tr>
              <tr>
                <th colspan="2" style="text-align: right;">Delivery</th>
                <td colspan="3"></td>
                <td colspan="2">{{"Rp. ".number_format($purchase->deliveryPrice, 2)}}</td>
              </tr>
              <tr>
                <th colspan="2" style="text-align: right;">Grand Total</th>
                <td colspan="3"></td>
                <td colspan="2">
                  @if ($purchase->deliveryOption=="free ongkir")
                    {{"Rp. ".number_format($purchase->deliveryPrice+$subTotal, 2)}}
                  @else
                    {{"Rp. ".number_format($subTotal, 2)}}
                  @endif
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop

@section('js')
  <script charset="utf-8">
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
  </script>
@stop
