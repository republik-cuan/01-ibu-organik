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
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" name="name" value="" placeholder="Nama item" autofocus>
            {!! $errors->first('name', '<p calss="help-block text-danger">:message</p>')!!}
            <label for="price">Harga</label>
            <input type="number" class="form-control" name="price" min="0" value="" placeholder="Nama item" autofocus>
            {!! $errors->first('price', '<p calss="help-block text-danger">:message</p>')!!}
            <label for="stock">Stok</label>
            <input type="number" class="form-control" name="stock" min="0" value="" placeholder="Nama item" autofocus>
            {!! $errors->first('stock', '<p calss="help-block text-danger">:message</p>')!!}
            <label for="categoy_id">Kategori</label>
            <select name="category_id" id="" class="form-control">
              <option value="">-- Choose Category --</option>
              @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
            {!! $errors->first('categoy_id', '<p calss="help-block text-danger">:message</p>')!!}
            <label for="supplier_id">Supplier</label>
            <select name="supplier_id" id="" class="form-control">
              <option value="">-- Choose Supplier --</option>
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
