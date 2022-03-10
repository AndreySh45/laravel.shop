@extends('layouts.admin_layout')
@section('title', 'Купоны')
@section('content')
       <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Купоны</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            @if (count($coupons))
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    ID
                                </th>
                                <th>
                                    Код
                                </th>
                                <th>
                                    Описание
                                </th>
                                <th style="width: 25%">
                                    Действия:
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>
                                        {{ $coupon->id }}
                                    </td>
                                    <td>
                                        {{ $coupon->code }}
                                    </td>
                                    <td>
                                        {{$coupon->description }}
                                    </td>
                                    <td class="project-actions text-right" style="width: 500px">
                                        <a class="btn btn-success btn-sm" href="{{ route('coupons.show', $coupon) }}">
                                            <i class="fas fa-tasks">
                                            </i>
                                            Открыть
                                        </a>
                                        <a class="btn btn-info btn-sm" href="{{ route('coupons.edit', $coupon) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Редактировать
                                        </a>
                                        <form action="{{ route('coupons.destroy', $coupon) }}" method="POST"
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
                {{ $coupons->links() }}
            </div>
            @else
                <p> Купонов пока нет...</p>
            @endif
        </div><!-- /.container-fluid -->
        <div class="card-footer clearfix">
            <a type="button" class="btn btn-primary float-right" href="{{ route('coupons.create') }}"><i class="fas fa-plus"></i> Добавить купон</a>
        </div>
      </section>
      <!-- /.content -->
@endsection
