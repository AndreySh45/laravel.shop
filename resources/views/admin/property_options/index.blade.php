@extends('layouts.admin_layout')
@section('title', 'Варианты свойства')
@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Варианты свойства</h1>
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
                @if (count($propertyOptions))
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    ID
                                </th>
                                <th>
                                    Свойство
                                </th>
                                <th>
                                    Название
                                </th>
                                <th style="width: 30%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($propertyOptions as $propertyOption)
                                <tr>
                                    <td>
                                        {{ $propertyOption->id }}
                                    </td>
                                    <td>
                                        {{ $propertyOption->property->name }}
                                    </td>
                                    <td>
                                        {{ $propertyOption->name }}
                                    </td>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('property-options.edit', [$property, $propertyOption]) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Редактировать
                                        </a>
                                        <form action="{{ route('property-options.destroy', [$property, $propertyOption]) }}" method="POST"
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
                    <p>Вариантов свойств товара пока нет...</p>
                @endif
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
        <div class="card-footer clearfix">
            <a type="button" class="btn btn-primary float-right" href="{{ route('property-options.create', $property) }}"><i class="fas fa-plus"></i> Добавить вариант свойства</a>
        </div>
      </section>
      <!-- /.content -->
@endsection
