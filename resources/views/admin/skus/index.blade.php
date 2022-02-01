@extends('layouts.admin_layout')
@section('title', 'Товарные предложения')
@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Товарные предложения</h1>
                    <h2>{{ $product->title }}</h2>
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
                @if (count($skus))
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    ID
                                </th>
                                <th>
                                    Товарное предложение
                                </th>
                                <th style="width: 30%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skus as $sku)
                                <tr>
                                    <td>
                                        {{ $sku->id }}
                                    </td>
                                    <td>
                                        {{ $sku->propertyOptions->map->name->implode(', ') }}
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('skus.edit', [$product, $sku]) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Редактировать
                                        </a>
                                        <form action="{{ route('skus.destroy', [$product, $sku]) }}" method="POST"
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
                    <p>Предложений товара пока нет...</p>
                @endif
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
        <div class="card-footer clearfix">
            <a type="button" class="btn btn-primary float-right" href="{{ route('skus.create', $product) }}"><i class="fas fa-plus"></i> Добавить Sku</a>
        </div>
      </section>
      <!-- /.content -->
@endsection
