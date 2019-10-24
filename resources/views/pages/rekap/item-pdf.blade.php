<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Rekap perBarang</title>
    <link rel="stylesheet" href="{{public_path('css/bootstrap.min.css')}}" type="text/css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <table class="table table-bordered">
      <thead class="text-center">
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Terjual</th>
          <th>Modal</th>
          <th>Total Harga</th>
          <th>Margin</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @foreach($items as $key=>$item)
          <tr>
            <td>{{$key+=1}}</td>
            <td>{{$item['name']}}</td>
            <td>{{$item['sold']}}</td>
            <td>{{"Rp. ".number_format($item['modal'], 2)}}</td>
            <td>
              @php
                $subtotal = 0;
                $margin = 0;
                $harga = 0;
                foreach($item['purchases'] as $purchase) {
                  switch($purchase['statusHarga']) {
                    case 'reseller':
                      $harga = $item['reseller'];
                      break;
                    case 'end user':
                      $harga = $item['endUser'];
                      break;
                    case 'modal':
                      $harga = $item['modal'];
                      break;
                  }
                  $subtotal += ($harga*$purchase['pivot']->total);
                }
                echo "Rp. ".number_format($subtotal, 2);
              @endphp
            </td>
            <td>
              @php
                foreach($item['purchases'] as $purchase) {
                  $margin += $purchase['pivot']->total * $item['modal'];
                }
                echo "Rp. ".number_format($subtotal-$margin, 2);
              @endphp
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
