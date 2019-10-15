<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Pelanggan</th>
      <th>Status Harga</th>
      <th>Ongkir</th>
      <th>Margin</th>
      <th>Total Harga</th>
      <th>Grand Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach($purchases as $key=>$purchase)
      <tr>
        <td>{{$key+=1}}</td>
        <td>{{$purchase['customer']->name}}</td>
        <td>{{$purchase['statusHarga']}}</td>
        <td>{{"Rp. ".number_format($purchase['deliveryPrice'], 2)}}</td>
        <td>
          @php
            $total = 0;
            $margin = 0;
            $harga = 0;
            foreach($purchase['inventories'] as $inventory) {
              switch($purchase['statusHarga']) {
                case 'reseller':
                  $harga = $inventory->item->reseller;
                  break;
                case 'end user':
                  $harga = $inventory->item->endUser;
                  break;
                case 'modal':
                  $harga = $inventory->item->modal;
                  break;
              }
              $total += ($harga*$inventory->total);
              $margin += ($harga-$inventory->item->modal)*$inventory->total;
            }
            echo "Rp. ".number_format($margin, 2);
          @endphp
        </td>
        <td>{{"Rp. ".number_format($total, 2)}}</td>
        <td>{{"Rp. ".number_format($total+=$purchase['deliveryPrice'])}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
