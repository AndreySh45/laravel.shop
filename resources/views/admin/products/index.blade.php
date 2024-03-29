@extends('layouts.admin_layout')
@section('title', 'Товары')
@section('content')
       <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все товары</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            @if (count($products))
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    ID
                                </th>
                                <th>
                                    Название
                                </th>
                                <th>
                                    Категория
                                </th>
                                <th>
                                    Кол-во товарных предложений
                                </th>
                                <th style="width: 180px">
                                    Дата добавления
                                </th>
                                <th>
                                    Действия:
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        {{ $product['id'] }}
                                    </td>
                                    <td>
                                        {{ $product['title'] }}
                                    </td>
                                    <td>
                                        {{ $product->category['title'] }}
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        {{ $product['created_at'] }}
                                    </td>
                                    <td class="project-actions text-right" style="width: 330px">
                                        <a class="btn btn-info btn-sm" href="{{ route('products.edit', $product['id']) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Редактировать
                                        </a>
                                        <a class="btn btn-success btn-sm" href="{{ route('skus.index', $product) }}">
                                            <i class="fas fa-tasks">
                                            </i>
                                            SKUS
                                        </a>
                                        <form action="{{ route('products.destroy', $product['id']) }}" method="POST"
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
                </div>
                     <!-- /.card-body -->
            </div>
            <div class="col-md-12 mb-3">
                {{ $products->links() }}
            </div>
            @else
                <p> Товаров пока нет...</p>
            @endif
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection
