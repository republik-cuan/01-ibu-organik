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
      <th>No Invoice</th>
      <td>{{$purchase->kode}}</td>
      <td class="text-right">{{ date_format($purchase->created_at, "l, d-m-Y") }}</td>
    </tr>
    <tr>
      <th>Nama</th>
      <td>{{$customer->name}}</td>
      <td class="text-right">{{ ucwords($purchase->deliveryOption) }}</td>
    </tr>
    <tr>
      <th>Telp</th>
      <td>{{$customer->phone}}</td>
    </tr>
    <tr>
      <th>Rekening</th>
      <td>
        {{ $purchase->bank->bank." | ".$purchase->bank->rekening }}
      </td>
    </tr>
    <tr>
      <th>Alamat</th>
      <td>{{$customer->address}}</td>
    </tr>
    <tr>
      <th>Patokan</th>
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
      </tr>
    @endforeach
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
            <td>{{ $item->total." gram" }}</td>
            <td colspan="2" class="text-left px-4">{{ "Rp. ".number_format($item->discount, 2) }}</td>
          </tr>
        @endif
      @endforeach
      <tr>
        <td colspan="5">
          <span class="text-white">hello</span>
        </td>
      </tr>
      <tr>
        <th colspan="2" class="text-left px-2">Total</th>
        <td>{{number_format($berat, 2)}}</td>
        <td>{{"Rp. ".number_format($harga,2)}}</td>
        <td>{{"Rp. ".number_format($subTotal,2)}}</td>
      </tr>
      <tr>
        <th colspan="2" class="text-left px-2">Delivery</th>
        <td colspan="2"></td>
        <td>{{"Rp. ".number_format($purchase->deliveryPrice,2)}}</td>
      </tr>
      <tr>
        <th colspan="2" class="text-left px-2">Grand Total</th>
        <td colspan="2"></td>
        <td>{{"Rp. ".number_format($purchase->deliveryPrice+$subTotal,2)}}</td>
      </tr>
    </tbody>
  </table>
</body>
</html>
