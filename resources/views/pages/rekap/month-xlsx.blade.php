<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Bulan</th>
      <th>Total Bayar</th>
      <th>Margin</th>
    </tr>
  </thead>
  <tbody>
    @if ($label=="with")
      @foreach ($purchases as $key => $purchase)
        <tr>
          <td>{{$key+=1}}</td>
          <td>{{date_format($purchase['created_at'], "F Y")}}</td>
          <td>
            @php
              $harga = 0;
              $subtotal = 0;
              $margin = 0;
              foreach($purchase['inventories'] as $datum) {
                switch($purchase['statusHarga']){
                  case 'reseller':
                    $harga = $datum['item']->reseller;
                    break;
                  case 'modal':
                    $harga = $datum['item']->modal;
                    break;
                  case 'end user':
                    $harga = $datum['item']->endUser;
                    break;
                }
                $subtotal += ($datum['total']*$harga);
                $margin += ($datum['total']*$datum['item']->modal);
              }
              echo "Rp. ".number_format($subtotal, 2);
            @endphp
          </td>
          <td>{{"Rp. ".number_format(($subtotal-$margin), 2)}}</td>
        </tr>
      @endforeach
    @else
      @php
        $i = 0;
      @endphp
      @foreach ($purchases as $key => $beli)
        <tr>
          <td>{{$i+=1}}</td>
          <td>{{date("F Y", strtotime($key))}}</td>
          <td>
            @php
             $subtotal = 0;
             $margin = 0;
             foreach($beli as $data) {
               if (sizeof($data['inventories'])>0) {
                 foreach($data['inventories'] as $datum) {
                   switch($data['statusHarga']) {
                     case "reseller":
                       $harga = $datum['item']->reseller;
                       break;
                     case "modal":
                       $harga = $datum['item']->modal;
                       break;
                     case "end user":
                       $harga = $datum['item']->endUser;
                       break;
                   }
                   $subtotal += ($harga * $datum['total']);
                   $margin += ($datum['item']->modal * $datum['total']);
                 }
               }
             }
             echo "Rp. ".number_format($subtotal, 2);
            @endphp
          </td>
          <td>{{"Rp. ".number_format(($subtotal - $margin), 2)}}</td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
