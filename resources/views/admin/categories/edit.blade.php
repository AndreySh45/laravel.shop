@extends('layouts.admin_layout')
@section('title', 'Редактирование категории')
@section('content')
       <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование категории: {{ $category->title }}</h1>
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
                        <form role="form" method="POST" action="{{ route('categories.update', ['category' => $category->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method ('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название</label>
                                    <input type="text" value="{{ $category->title }}" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1"
                                        placeholder="Введите название категории" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название по-английски</label>
                                    <input type="text" value="{{ $category->title_en }}" name="title_en" class="form-control @error('title_en') is-invalid @enderror" id="exampleInputEmail1"
                                        placeholder="Enter category name" required>
                                </div>
                                <div class="form-group">
                                    <label for="desc">Описание категории</label>
                                    <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" id="desc" rows="3" placeholder="Описание ...">{{ $category['desc'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="desc_en">Описание категории по-английски</label>
                                    <textarea name="desc_en" class="form-control @error('desc_en') is-invalid @enderror" id="desc_en" rows="3" placeholder="Description ...">{{ $category['desc_en'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="img">Изображение</label>
                                    <div class="input-group">
                                        <input type="file" name="img" id="img">
                                    </div>
                                </div>
                                <div><img src="{{ $category->getImage() }}" alt="" class="img-thumbnail mt-2" width="200"></div>
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
