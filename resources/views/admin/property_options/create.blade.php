@extends('layouts.admin_layout')
@section('title', 'Добавить вариант свойства')
@section('content')
       <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить вариант свойства товара</h1>
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
                        <form role="form" method="POST" action="{{ route('property-options.store', $property) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div>
                                    <h2>Свойство: {{ $property->name }}</h2>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                    value="{{ old('name', isset($propertyOption) ? $propertyOption->name : null) }}" placeholder="Введите вариант свойства" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название по-английски</label>
                                    <input type="text" name="name_en" class="form-control" id="exampleInputEmail1"
                                    value="{{ old('name_en', isset($propertyOption) ? $propertyOption->name_en : null) }}" placeholder="Enter property variant" required>
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
