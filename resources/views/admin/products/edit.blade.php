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
                                    <label for="exampleInputEmail1">Название по-английски</label>
                                    <input type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputEmail1"
                                    value="{{ old('title_en', isset($product) ? $product->title_en : null) }}" placeholder="Введите английское название товара" required>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                        <div class="form-group">
                                          <label>Свойства товара</label>
                                            <select name="property_id[]" class="form-control" multiple>
                                                @foreach ($properties as $property)
                                                    <option value="{{ $property->id }}"
                                                        @isset($product)
                                                            @if($product->properties->contains($property->id))
                                                            selected
                                                            @endif
                                                        @endisset>
                                                        {{$property->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="form-inline">
                                    <div class="form-check mb-2 mr-sm-2">
                                            <div class="form-check">
                                                <input name="in_stock" class="form-check-input" type="checkbox" id="in_stock"
                                                @if(isset($product) && $product->in_stock === 1)
                                                        checked="checked"
                                                @endif
                                                >
                                                <label class="form-check-label">Наличие товара</label>
                                            </div>
                                            <br>
                                        </div>
                                        @foreach ([
                                            'hit' => 'Хит',
                                            'new' => 'Новинка',
                                            'recommend' => 'Рекомендуемые'
                                            ] as $field => $title)
                                            <div class="form-check mb-2 mr-sm-2">
                                                <label for="code" class="form-check-label">{{ $title }}: </label>
                                                <div class="ml-2">
                                                    <input class="form-check-input" type="checkbox" name="{{$field}}" id="{{$field}}"
                                                    @if(isset($product) && $product->$field === 1)
                                                        checked="checked"
                                                    @endif
                                                    >
                                                </div>
                                            </div>
                                        @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="description">Описание товара</label>
                                    <textarea name="description" class="editor @error('description') is-invalid @enderror">{{ $product['description'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description_en">Описание товара по-английски</label>
                                    <textarea name="description_en" class="editor @error('description_en') is-invalid @enderror">{{ $product['description_en'] }}</textarea>
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
                                            <img src="{{$product->getImage()}}" alt="{{$product->title}}" class="img-uploaded" style="display: block; width: 300px">
                                            <input type="text" class="form-control mt-2" id="feature_image" value="{{ $product->getImage() }}" name="img" value="" readonly>
                                        @else
                                            <img src="{{$product->getImage()}}" alt="{{$product->title}}" class="img-uploaded" style="display: block; width: 300px">
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
