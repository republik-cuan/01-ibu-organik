<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Pelanggan</th>
      <th>Status Harga</th>
      <th>Total Harga</th>
      <th>Gran Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach($purchases as $key=>$purchase)
      <tr>
        <td>{{$key}}</td>
        <td>{{$purchase->customer->name}}</td>
        <td>{{$purchase->statusHarga}}</td>
        <td>
        </td>
        <td></td>
      </tr>
    @endforeach
  </tbody>
</table>