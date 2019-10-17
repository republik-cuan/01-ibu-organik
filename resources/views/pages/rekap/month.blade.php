@extends('adminlte::page')

@section('title', 'Rekap Barang')

@section('content_header')
    <h1>Rekap Barang</h1>
@stop

@section('content')
  <div class="box box-danger">
    <div class="box-body">
      <div class="row">
        <div class="col-md-6 col-md-offset-6 text-right">
          <form action="{{route('rekap.export-month')}}" method="post">
            @csrf
            <button class="btn btn-success" type="submit" style="margin-bottom: 10px;">Cetak</button>
          </form>
        </div>
        <div class="col-md-12">
          <table id="table-item" class="data-table table table-bordered table-hover text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Total Harga</th>
                <th>Margin</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop


@section('js')
<script charset="utf-8">
  let harga = 0;
  let foo = 0;
  let baz = 0;
  let bar = 0;
  let purchases = [];
  const label = "{!! $label !!}";
  const purchasesBefore = {!! $purchases !!};
  if (label!=="with") {
    for (let id in purchasesBefore) {
      foo = 0;
      baz = 0;
      let data = purchasesBefore[id];
      data.map((datum, idx) => {
        if (datum.inventories.length>0) {
          datum.inventories.map((val) => {
            switch(datum.statusHarga) {
              case 'reseller':
                harga = val.item.reseller;
                break;
              case 'modal':
                harga = val.item.modal;
                break;
              case 'end user':
                harga = val.item.endUser;
                break;
            }
            foo += (val.total*harga);
            baz += (val.total*val.item.modal);
          });
        }
        return ({
          'label': id,
          'total_harga': foo,
          'margin': foo-baz,
        });
      });
      let dt = new Date(id);
      purchases = [...purchases, {
        'label': dt.toLocaleDateString("id", {year: "numeric", month: "long"}),
        'total_harga': foo,
        'margin': (foo-baz),
      }];
    }
  } else {
    purchasesBefore.map(data => {
      if (data.inventories.length>0) {
        data.inventories.map(datum => {
          switch(data.statusHarga) {
            case 'reseller':
              harga = datum.item.reseller;
              break;
            case 'modal':
              harga = datum.item.modal;
              break;
            case 'end user':
              harga = datum.item.endUser;
              break;
          }
          foo += (datum.total * harga);
          baz += (datum.total * datum.item.modal);
        })
      }
    });
    let dt = new Date(purchasesBefore[0].created_at);
    purchases = [...purchases, {
      'label': dt.toLocaleDateString("id", {year: "numeric", month: "long"}),
      'total_harga': foo,
      'margin': (foo-baz),
    }]
  }
  $(document).ready(function(){
    $('#table-item').dataTable({
      data: purchases,
      columns: [{
          data: 'id',
          render: function(data) {
            return arguments[3].row+=1;
          },
        },
        { data: 'label' },
        {
          data: 'total_harga',
          render: function(data) {
            return `Rp. ${new Intl.NumberFormat().format(data)}`;
          },
        },
        {
          data: 'margin',
          render: function(data) {
            return `Rp. ${new Intl.NumberFormat().format(data)}`;
          },
        },
      ]
    });
  });
</script>
@endsection
