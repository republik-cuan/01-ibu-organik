@extends('adminlte::page')

@section('title', 'Edit Item')

@section('content_header')
<div class="row">
  <div class="col-md-6">
    <h3>Edit item<h3>
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
    <div class="container">
      <div class="row">
        <div class="col-md-6">
        <form action="{{route ('item.update', $item->id)}}" method="post">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="form-group">
              <label for="name">Nama</label>
            <input type="text" class="form-control" name="name" value="{{ $item->name }}" placeholder="Nama Item" autofocus>
              {!! $errors->first('name', '<p class="help-block text-danger">:message</p>')!!}
              <label for="price">Harga</label>
              <input type="number" class="form-control" name="price" value="{{ $item->price }}" placeholder="Harga Item" autofocus>
              {!! $errors->first('price', '<p class="help-block text-danger">:message</p>')!!}
              <label for="number">Stok</label>
              <input type="text" class="form-control" name="stock" value="{{ $item->stock }}" placeholder="Stok Item" autofocus>
              {!! $errors->first('stock', '<p class="help-block text-danger">:message</p>')!!}
              <label for="categoy_id">Kategori</label>
              <select name="category_id" id="" class="form-control">
                <option disabled selected>{{ $item->category->name}}</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
              {!! $errors->first('categoy_id', '<p calss="help-block text-danger">:message</p>')!!}
              <label for="supplier_id">Supplier</label>
              <select name="supplier_id" id="" class="form-control">
                  <option disabled selected>{{ $item->supplier->name }}</option>
                  @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
</div>
@stop
@section('js')
<script>
  console.log('Hi!');
</script>
@stop