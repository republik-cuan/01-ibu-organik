@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
  <div class="row">
    @foreach ($cards as $card)
      <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="info-box">
          <div class="info-box-icon {{$card['color']}}">
            <i class="ion {{$card['icon']}}"></i>
          </div>
          <div class="info-box-content">
            <span class="info-box-title">{{$card['title']}}</span>
            <span class="info-box-number">{{$card['value']}}</span>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="box box-default">
        <div class="box-header">
          <h3 class="box-title">Grafik Penjualan</h3>
        </div>
        <div class="box-body">
          <canvas id="invoice"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="box box-default">
        <div class="box-header">
          <h3 class="box-title">Barang Terjual</h3>
        </div>
        <div class="box-body">
          <canvas id="item"></canvas>
        </div>
      </div>
    </div>
  </div>
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script charset="utf-8">
    const invoice = document.getElementById('invoice');
    const item = document.getElementById('item');
    const purchases = {!! $purchases !!};
    const items = {!! $items !!};
    let temp = [];

    @foreach ($purchase->deliveries as $delivery)
      temp = [...temp, "{{$delivery}}"];
    @endforeach

    let penjualan = temp.map((datum, id) => {
      return ({
        'label': datum,
        'value': 0,
      });
    });

    purchases.map(data => {
      penjualan.map(datum => {
        if (data.deliveryOption===datum.label) {
          datum.value++;
        }
      });
    });

    new Chart(invoice, {
      type: 'bar',
      data: {
        labels: penjualan.map(datum => datum.label),
        datasets: [{
          label: "Jumlah Penjualan",
          data: penjualan.map(datum => datum.value),
          backgroundColor: ['red', 'green', 'orange', 'yellow', 'lightblue'],
        }],
      },
    });

    new Chart(item, {
      type: 'pie',
      data: {
        labels: items.map(datum => datum.name),
        datasets: [{
          label: "Jumlah Barang",
          data: items.map(datum => datum.sold),
          backgroundColor: ['salmon', 'lightgreen', 'lightblue', 'lightseagreen'],
        }]
      },
      options: {}
    })
  </script>
@stop
