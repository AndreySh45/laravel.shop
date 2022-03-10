@extends('layouts.admin_layout')
@section('title', 'Все свойства')
@section('content')
       <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все свойства товара</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                @if (count($properties))
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    ID
                                </th>
                                <th>
                                    Название
                                </th>
                                <th style="width: 50%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($properties as $property)
                                <tr>
                                    <td>
                                        {{ $property['id'] }}
                                    </td>
                                    <td>
                                        {{ $property['name'] }}
                                    </td>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('properties.edit', $property['id']) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Редактировать
                                        </a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('property-options.index', $property) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Значения свойства
                                        </a>
                                        <form action="{{ route('properties.destroy', $property['id']) }}" method="POST"
                                        style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                <i class="fas fa-trash">
                                                </i>
                                                Удалить
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                @else
                    <p>Свойств товара пока нет...</p>
                @endif
                </div>
                <!-- /.card-body -->
            </div>


        </div><!-- /.container-fluid -->
        <div class="card-footer clearfix">
            <a type="button" class="btn btn-primary float-right" href="{{ route('coupons.create') }}"><i class="fas fa-plus"></i> Добавить купон</a>
        </div>
      </section>
      <!-- /.content -->
@endsection
