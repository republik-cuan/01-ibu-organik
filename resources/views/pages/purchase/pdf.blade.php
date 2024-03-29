<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{public_path('css/bootstrap.min.css')}}">
  <title>Invoice | {{$purchase->kode}}</title>
</head>
<body>
  <table class="w-100">
    <tr>
      <td colspan="3" rowspan="5">
        <img src="{{ public_path('img/logo_cetak.png') }}" alt="" style="width: 100;"/>
      </td>
    </tr>
    <tr>
      <th class="text-right h2" colspan="3">INVOICE</th>
    </tr>
    <tr>
      <th class="text-right" colspan="2">Date</th>
      <td class="text-right">{{ date_format($purchase->created_at, 'm/d/Y') }}</td>
    </tr>
    <tr>
      <th class="text-right" colspan="2">Invoice</th>
      <td class="text-right">{{ $purchase->kode }}</td>
    </tr>
    <tr>
      <th class="text-right" colspan="2">Rekening</th>
      <td class="text-right">
        {{ $purchase->bank->bank }}
        <br>
        {{ $purchase->bank->rekening }}
      </td>
    </tr>
  </table>
  <br></br>
  <table class="w-100">
    <tr>
      <th class="bg-success" colspan="5">Bill To:</th>
    </tr>
    <tr>
      <th class="px-3 w-25">Nama</th>
      <td>{{$customer->name}}</td>
      <th class="text-right">Pengiriman</th>
      <td colspan="2" class="text-right">{{ ucwords($purchase->deliveryOption) }}</td>
    </tr>
    <tr>
      <th class="px-3 w-25">Telp</th>
      <td>{{$customer->phone}}</td>
    </tr>
    <tr>
      <th class="px-3 w-25">Alamat</th>
      <td>{{$customer->address}}</td>
    </tr>
    <tr>
      <th class="px-3 w-25">Patokan</th>
      <td>{{ucwords($customer->patokan)}}</td>
    </tr>
  </table>
  <table class="w-100 my-5 text-center" border="1">
    <thead class="text-center">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jumlah(gram)</th>
        <th>Harga</th>
        <th>Sub Harga</th>
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
        <td>{{ ucwords($item->item->name) }}</td>
        <td>
          @php
            $berat += $item->total;
            $discount += $item->discount;
            echo $item->total;
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
            $subTotal += $temp;
            echo "Rp. ".number_format($temp, 2);
          @endphp
        </td>
      </tr>
    @endforeach
    @if ($discount > 0)
      <tr>
        <th colspan="5" class="text-left px-2">
          Diskon
        </th>
      </tr>
      @foreach ($inventories as $key => $item)
        @if ($item->discount > 0)
          <tr>
            <td>{{ $key+=1 }}</td>
            <td>{{ ucwords($item->item->name) }}</td>
            <td colspan="2" class="text-right px-4">{{ "Rp. ".number_format($item->discount, 2) }}</td>
            <td></td>
          </tr>
        @endif
      @endforeach
    @endif
      <tr>
        <td colspan="5">
          <span class="text-white">text-kosong</span>
        </td>
      </tr>
      <tr>
        <th colspan="4" class="text-left px-2">Total Harga</th>
        <td>{{"Rp. ".number_format($subTotal,2)}}</td>
      </tr>
      @if ($discount > 0)
        <tr>
          <th colspan="4" class="text-left px-2">Total Diskon</th>
          <td>{{"Rp. ".number_format($discount,2)}}</td>
        </tr>
        <tr>
          <th colspan="4" class="text-left px-2">Total Setelah Diskon</th>
          <td>{{"Rp. ".number_format($subTotal-$discount,2)}}</td>
        </tr>
      @endif
      <tr>
        <th colspan="4" class="text-left px-2">Delivery</th>
        <td>
          @if ($purchase['deliveryOption']=='free ongkir')
            {{"Rp. ".number_format($purchase->deliveryPrice,2)}}
          @else
            -
          @endif
        </td>
      </tr>
      <tr>
        <th colspan="4" class="text-left px-2">Grand Total</th>
        <td>
          @php
            if ($purchase['deliveryOption']=='free ongkir')
              echo "Rp. ".number_format(($subTotal-$discount) - $purchase->deliveryPrice,2);
            else
              echo "Rp. ".number_format($subTotal-$discount,2);
          @endphp
        </td>
      </tr>
    </tbody>
  </table>
</body>
</html>
