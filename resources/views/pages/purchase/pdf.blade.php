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
  <table>
    <tr>
      <th>No Invoice</th>
      <td class="px-3">{{$purchase->kode}}</td>
    </tr>
    <tr>
      <th>Nama</th>
      <td class="px-3">{{$customer->name}}</td>
    </tr>
    <tr>
      <th>Alamat</th>
      <td class="px-3">{{$customer->address}}</td>
    </tr>
    <tr>
      <th>Telp</th>
      <td class="px-3">{{$customer->phone}}</td>
    </tr>
    <tr>
      <th>Delivery By</th>
      <td class="px-3">{{$purchase->deliveryOption}}</td>
    </tr>
    <tr>
      <th>Date</th>
      <td class="px-3">{{date_format($purchase->created_at, "d M Y")}}</td>
    </tr>
  </table>
  <table class="w-100 my-5 text-center" border="1">
    <thead class="text-center">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Diskon</th>
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
      </tr>
    @endforeach
      <tr>
        <th colspan="2">Total</th>
        <td></td>
        <td>{{number_format($berat, 2)}}</td>
        <td>{{"Rp. ".number_format($harga,2)}}</td>
        <td>{{"Rp. ".number_format($subTotal,2)}}</td>
      </tr>
      <tr>
        <th colspan="2">Delivery</th>
        <td colspan="3"></td>
        <td>{{"Rp. ".number_format($purchase->deliveryPrice,2)}}</td>
      </tr>
      <tr>
        <th colspan="2">Gran Total</th>
        <td colspan="3"></td>
        <td>{{"Rp. ".number_format($purchase->deliveryPrice+$subTotal,2)}}</td>
      </tr>
    </tbody>
  </table>
</body>
</html>
