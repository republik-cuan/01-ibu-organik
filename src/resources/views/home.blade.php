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
    const invoice = document.getElementById('invoice').getContext('2d');
    const item = document.getElementById('item').getContext('2d');
    const MONTH = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const chartInvoice = new Chart(invoice, {
    type: 'pie',
    data: {
      datasets: [{
        data: [10,30,27,19,29],
        backgroundColor: function(context) {
          const index = context.dataIndex;
          return index % 2 ? 'blue' : 'green';
        },
      }],
      labels: ['hello', 'world', 'hello', 'happy', 'world'],
    }
    });
  </script>
@stop
