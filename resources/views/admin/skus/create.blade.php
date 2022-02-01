@extends('layouts.admin_layout')
@section('title', 'Создать SKU')
@section('content')
       <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить SKU</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('skus.store', $product) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div>
                                    <h2>Товар: {{ $product->title }}</h2>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Цена товара</label>
                                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="exampleInputEmail1"
                                    value="{{ old('price', isset($skus) ? $skus->price : null) }}"    placeholder="Введите цену" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Количество</label>
                                    <input type="text" name="count" class="form-control @error('count') is-invalid @enderror" id="exampleInputEmail1"
                                    value="{{ old('count', isset($skus) ? $skus->count : null) }}"    placeholder="Введите количество товара" required>
                                </div>

                                @foreach ($product->properties as $property)
                                    <div class="form-group">
                                        <!-- select -->
                                            <div class="form-group">
                                            <label for="property_id[{{ $property->id }}]">{{ $property->name }}:</label>
                                                <select name="property_id[{{ $property->id }}]" class="form-control">
                                                    @foreach ($property->propertyOptions as $propertyOption)
                                                        <option value="{{ $propertyOption->id }}"
                                                            @isset($skus)
                                                                @if($skus->propertyOption->contains($propertyOption->id))
                                                                selected
                                                                @endif
                                                            @endisset>
                                                            {{$propertyOption->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection
