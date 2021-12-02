@extends('layouts.admin_layout')
@section('title', 'Заказы')
@section('content')
       <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все заказы</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            @if (count($orders))
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    ID
                                </th>
                                <th>
                                    Имя
                                </th>
                                <th>
                                    Телефон
                                </th>
                                <th>
                                    Когда отправлен
                                </th>
                                <th>
                                    Сумма
                                </th>
                                <th style="width: 30%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        {{ $order->id }}
                                    </td>
                                    <td>
                                        {{ $order->name }}
                                    </td>
                                    <td>
                                        {{ $order->phone }}
                                    </td>
                                    <td>
                                        {{ $order->created_at->format('H:i d/m/Y') }}
                                    </td>
                                    <td>
                                        {{ $order->calculateFullSum() }} руб.
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('orders.show', $order) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Открыть
                                        </a>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
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
            @else
                <p> Заказов пока нет...</p>
            @endif
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection
