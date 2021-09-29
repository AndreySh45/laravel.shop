@extends('layouts.admin_layout')
@section('title', 'Добавить категорию')
@section('content')
       <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить категорию</h1>
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
                        <form role="form" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название</label>
                                    <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                    value="{{ old('title', isset($category) ? $category->title : null) }}" placeholder="Введите название категории" required>
                                </div>
                                <div class="form-group">
                                    <label for="desc">Описание категории</label>
                                    <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" id="desc" rows="3" placeholder="Описание ..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="img">Изображение</label>
                                    <div class="input-group">
                                        <input type="file" name="img" id="img">
                                    </div>
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
