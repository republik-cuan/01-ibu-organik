@extends('adminlte::page')

@section('title', 'Penjualan')

@section('content_header')
  <div class="row">
    <div class="col-md-6">
      <h3>Pembelian</h3>
    </div>
    <div class="col-md-6 text-right">
      <h3>
        <a class="btn btn-info" href="{{route('purchase.create')}}">
          Tambah Pembelian
        </a>
      </h3>
    </div>
  </div>
@stop



@section('content')
  <div class="box box-danger">
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <table id="data-table" class="data-table table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Bank</th>
                <th>Tanggal Transfer</th>
                <th>Pengiriman</th>
                <th>Total Bayar</th>
                <th>Status Pembayaran</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop

@section('js')
  <script>
    $(document).ready(function() {
      $('.data-table').dataTable({
        data: {!! $purchases !!},
        columns: [
          {
            data: 'id',
            render: function(data) {
              return arguments[3].row+=1;
            },
          },
          { data: 'customer.name' },
          {
            data: 'bank',
            render: function(data) {
              return `${data.bank} | ${data.rekening}`;
            }
          },
          {
            data: 'created_at',
            render: function(data) {
              const temp = new Date(data);
              return temp.toLocaleString('id-ID', { timezone: 'UTC' });
            }
          },
          { data: 'deliveryOption' },
          {
            data: 'statusHarga',
            render: function(data) {
              let hasil = 0;
              let temp = 0;
              if (arguments[2].inventories.length>0) {
                switch(data) {
                  case 'reseller':
                    hasil = arguments[2].inventories.map(datum => {
                      return (datum.total*datum.item.reseller) - datum.discount;
                    });
                    break;
                  case 'modal':
                    hasil = arguments[2].inventories.map(datum => {
                      return (datum.total*datum.item.modal) - datum.discount;
                    });
                    break;
                  case 'end user':
                    hasil = arguments[2].inventories.map(datum => {
                      return (datum.total*datum.item.endUser) - datum.discount;
                    });
                    break;
                  default:
                    hasil = 0;
                    break;
                }
                temp = hasil.reduce((acc, datum) => acc + datum);
              }
              return `${data} | Rp. ${new Intl.NumberFormat().format(temp)}`
            }
          },
          {
            data: 'statusPembayaran',
            render: function(data) {
              const color = data==="terbayar" ? 'bg-green' : 'bg-red';
              return '<p class="'+color+'">'+data+'</p>';
            }
          },
          {
            data: 'id',
            render: function(data){
              const link ="{{route('purchase')}}"+"/"+data;
              const hh = "/inventories/"+data;
              const color = arguments[2].statusPembayaran === "terbayar" ? "btn-warning" : "btn-success";
              const label = arguments[2].statusPembayaran === "terbayar" ? "Batal" : "Verifikasi";
              let verified = '<form action="'+hh+'" style="margin: 0 3px; display: inline;" method="post">@csrf @method('put')<button class="btn '+color+' btn-xs">'+label+'</button></form>';
              const detail = '<a class="btn btn-info btn-xs" style="margin: 0 3px;" href="'+link+'/add">detail</a>';
              const edit = '<a class="btn btn-primary btn-xs" style="margin: 0 3px" href="'+link+'">edit</a>';
              const hapus = '<form role="form" action="'+link+'" style="margin: 0 3px;display:inline" method="POST">{{ csrf_field()}}{{method_field('delete')}}<button class="btn btn-danger btn-xs">delete</button></form>';
              const hasil = arguments[2].statusPembayaran === "terbayar" ? '<div class="text-center">'+verified+detail+'</div>' : '<div class="text-center">'+verified+detail+edit+hapus+'</div>';
              return hasil;
            }
          }
        ]
      });
    });
  </script>
@stop
