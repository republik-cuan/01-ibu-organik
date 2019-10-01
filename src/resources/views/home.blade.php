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
    const invoice = document.getElementById('invoice').getContext('2d')
    const item = document.getElementById('item').getContext('2d')
    const purchaseValue = {!! $purchases['value'] !!}
    const tempPurchaseLabel = {!! $purchases['label'] !!}
    const purchaseValue = tempPurchaseLabel.map(value => ({
      'label': value.deliveryOption,
      'data': value.total,
    }))
    const chartInvoice = new Chart(invoice, {
      type: 'bar',
      data: {
        labels: purchaseLabel,
        datasets: purchaseValue,
      },
      options: {
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Bulan'
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Jumlah'
            }
          }],
        }
      }
    });
  </script>
@stop
