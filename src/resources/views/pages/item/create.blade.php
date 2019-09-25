@extends('adminlte::page')

@section('title', 'Tambah Item')

@section('content_header')
<div class="row">
  <div class="col-md-6">
    <h3>Tambah item<h3>
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
            <input type="text" class="form-control" name="name" placeholder="Nama Item" autofocus>
            {!! $errors->first('name', '<p calss="help-block text-danger">:message</p>')!!}
            <label for="modal">Harga Modal</label>
            <input type="number" class="form-control" name="modal" placeholder="Harga Item" autofocus>
            {!! $errors->first('modal', '<p calss="help-block text-danger">:message</p>')!!}
            <label for="reseller">Harga Reseller</label>
            <input type="number" class="form-control" name="reseller" placeholder="Harga Item" autofocus>
            {!! $errors->first('reseller', '<p calss="help-block text-danger">:message</p>')!!}
            <label for="endUser">Harga Pelanggan</label>
            <input type="number" class="form-control" name="endUser" placeholder="Harga Item" autofocus>
            {!! $errors->first('endUser', '<p calss="help-block text-danger">:message</p>')!!}
            <label for="number">Stok</label>
            <input type="number" class="form-control" name="stock" placeholder="Stok Item" autofocus>
            {!! $errors->first('stock', '<p calss="help-block text-danger">:message</p>')!!}
            <label for="categoy_id">Kategori</label>
            <select name="category_id" id="" class="form-control">
              <option>-- Choose Category --</option>
              @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
          </select>
          {!! $errors->first('categoy_id', '<p calss="help-block text-danger">:message</p>')!!}
          <label for="supplier_id">Supplier</label>
          <select name="supplier_id" id="" class="form-control">
            <option>-- Choose Supplier --</option>
            @foreach ($suppliers as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
          {!! $errors->first('supplier_id', '<p calss="help-block text-danger">:message</p>')!!}
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
  console.log('Hi!');
</script>
@stop
