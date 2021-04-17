@extends('layouts.admin_layout')
@section('title', 'Редактирование товара')
@section('content')
       <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование товара: {{ $product->title }}</h1>
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
                        <form role="form" method="POST" action="{{ route('products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method ('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название</label>
                                    <input type="text" value="{{ $product->title }}" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Цена товара</label>
                                    <input type="text" value="{{ $product->price }}" name="price" class="form-control @error('price') is-invalid @enderror" id="exampleInputEmail1" required>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input name="in_stock" class="form-check-input" type="checkbox" value="1">
                                        <label class="form-check-label">Наличие товара</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Описание товара</label>
                                    <textarea name="description" class="editor @error('description') is-invalid @enderror">{{ $product['description'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                        <div class="form-group">
                                          <label>Выберите категорию</label>
                                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category['id']}}" @if ($category['id'] == $product['category_id']) selected @endif>
                                                        {{$category['title']}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="feature_image">Изображение товара</label>
                                    @foreach($product->images as $img)
                                        @if($loop->first)
                                            <img src="{{$img['img']}}" alt="{{$product->title}}" class="img-uploaded" style="display: block; width: 300px">
                                            <input type="text" class="form-control mt-2" id="feature_image" value="{{ $img['img'] }}" name="img" value="" readonly>
                                        @else
                                            <img src="{{$img['img']}}" alt="{{$product->title}}" class="img-uploaded" style="display: block; width: 300px">
                                            <input type="text" class="form-control mt-2" id="feature_image" value="{{ $img['img'] }}" name="img" value="" readonly>
                                        @endif
                                    @endforeach

                                    <a href="" class="popup_selector" data-inputid="feature_image">Выбрать изображение</a>
                                </div>
                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection
