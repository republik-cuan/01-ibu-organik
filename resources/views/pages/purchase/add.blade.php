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
            <label class="col-md-5 control-label" style="text-align: left;">Telp</label>
            <div class="col-md-7">
              <p class="form-control-static">{{$customer->phone}}</p>
            </div>
            <label class="col-md-5 control-label" style="text-align: left;">Rekening</label>
            <div class="col-md-7">
              <p class="form-control-static">{{ $purchase->bank->bank." | ".$purchase->bank->rekening }}</p>
            </div>
            <label class="col-md-5 control-label" style="text-align: left;">Alamat</label>
            <div class="col-md-7">
              <p class="form-control-static">{{ ucwords($customer->address) }}</p>
            </div>
            <label class="col-md-5 control-label" style="text-align: left;">Patokan</label>
            <div class="col-md-7">
              <p class="form-control-static">{{ ucwords($customer->patokan) }}</p>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 col-md-offset-4">
          <div class="form-horizontal">
            <div>
              <label class="col-md-5 control-label">Tanggal</label>
              <div class="col-md-7">
                <p class="form-control-static">
                  {{ date_format($purchase->created_at, 'l, d-m-Y') }}
                </p>
              </div>
            </div>
            <div>
              <label class="col-md-5 control-label">Pengiriman</label>
              <div class="col-md-7">
                <p class="form-control-static">
                  {{ ucwords($purchase->deliveryOption) }}
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <table class="data-table table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
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
                      $berat += $item->total;
                      echo $item->total." ".$item->item['satuan'];
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
                    @if ($purchase['statusPembayaran']!="terbayar")
                      <form action="{{route('inventories.destroy', $item->id)}}" method="post" disable>
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-xs">Hapus</button>
                      </form>
                    @endif
                  </td>
                </tr>
              @endforeach
              <tr>
                <th colspan="6" class="px-2" style="text-align: left">Diskon</th>
              </tr>
              @foreach ($inventories as $key => $item)
                <tr>
                  <td>{{ $key+=1 }}</td>
                  <td>{{ ucwords($item->item->name) }}</td>
                  <td>{{ $item->total." ".$item->item['statuan'] }}</td>
                  <td colspan="2">{{ "Rp. ".number_format($item->discount, 2) }}</td>
                </tr>
              @endforeach
              @if ($purchase['statusPembayaran']!="terbayar")
                <form action="{{route('inventories.store')}}" method="post">
                  @csrf
                  <tr>
                    <td>
                      <input type="number" name="purchase" id="purchase" value="{{$purchase->id}}" hidden>
                    </td>
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
                    <td>
                      <select name="bobot" id="bobot" class="form-control">
                        <option value="kilogram">Kilogram</option>
                        <option value="gram">Gram</option>
                        <option value="satuan">Satuan</option>
                      </select>
                    </td>
                    <td>
                      <button class="btn btn-primary" type="submit">
                        Submit
                      </button>
                    </td>
                  </tr>
                </form>
              @endif
              <tr>
                <th colspan="5" style="text-align: left;">Total</th>
                <td colspan="1">{{"Rp. ".number_format($subTotal,2)}}</td>
              </tr>
              <tr>
                <th colspan="5" style="text-align: left;">Delivery</th>
                <td>{{"Rp. ".number_format($purchase->deliveryPrice, 2)}}</td>
              </tr>
              <tr>
                <th colspan="5" style="text-align: left;">Grand Total</th>
                <td>
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
        <div class="col-md-12 text-right">
          <a class="btn btn-warning btn" href="{{route('purchase')}}">Simpan</a>
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
