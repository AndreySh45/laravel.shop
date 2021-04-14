@extends('layouts.admin_layout')
@section('title', 'Добавить товар')
@section('content')
       <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить товар</h1>
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
                        <form role="form" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название</label>
                                    <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                        placeholder="Введите название товара" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Описание товара</label>
                                    <textarea name="description" class="editor" placeholder="Описание ..."></textarea>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                        <div class="form-group">
                                          <label>Выберите категорию</label>
                                            <select name="category_id" class="form-control" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category['id']}}">{{$category['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="feature_image">Изображение товара</label>
                                    <img src="" alt="" class="img-uploaded" style="display: block; width: 300px">
                                    <input type="text" class="form-control mt-2" id="feature_image" name="feature_image" value="" readonly>
                                    <a href="" class="popup_selector" data-inputid="feature_image">Выбрать изображение</a>
                                </div>


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
