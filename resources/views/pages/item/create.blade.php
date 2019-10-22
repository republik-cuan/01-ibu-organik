@extends('adminlte::page')

@section('title', 'Tambah Item')

@section('content_header')
<div class="row">
  <div class="col-md-6">
    <h3>Tambah Item<h3>
  </div>
  <div class="col-md-6 text-right">
    <h3>
      <a type="button" class="btn btn-info" href="{{route('item')}}">
        Kembali
      </a>
    </h3>
  </div>
</div>
@stop

@section('content')
<div class="box box-danger">
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
        <form action="{{route ('item.store')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" name="name" placeholder="Nama Item" required>
            <label for="modal">Harga Modal</label>
            <input type="number" class="form-control" name="modal" placeholder="Harga Item" required>
            <label for="reseller">Harga Reseller</label>
            <input type="number" class="form-control" name="reseller" placeholder="Harga Item" required>
            <label for="endUser">Harga Pelanggan</label>
            <input type="number" class="form-control" name="endUser" placeholder="Harga Item" required>
            <label for="number">Stok</label>
            <input type="number" class="form-control" name="stock" placeholder="Stok Item" required>
            <label for="berat">Berat</label>
            <select class="form-control" name="berat" id="berat" required>
              @foreach ($berat as $item)
                <option value="{{$item}}">
                  {{$item}}
                </option>
              @endforeach
            </select>
            <label for="satuan">Satuan</label>
            <select class="form-control" name="satuan" id="satuan" required>
              @foreach ($satuan as $item)
                <option value="{{$item}}">
                  {{$item}}
                </option>
              @endforeach
            </select>
            <label for="categoy_id">Kategori</label>
            <select name="category_id" id="" class="js-example-basic-single form-control" required>
              @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
            <label for="supplier_id">Supplier</label>
            <select name="supplier_id" id="" class="js-example-basic-single form-control" required>
              @foreach ($suppliers as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-info">submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@stop


@section('js')
<script>
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });
</script>
@stop
