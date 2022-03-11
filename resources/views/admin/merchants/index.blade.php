@extends('layouts.admin_layout')
@section('title', 'Все поставщики')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Все поставщики</h1>
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
                @if (count($merchants))
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
                            @foreach ($merchants as $merchant)
                                <tr>
                                    <td>
                                        {{ $merchant['id'] }}
                                    </td>
                                    <td>
                                        {{ $merchant['name'] }}
                                    </td>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-success btn-sm" href="{{ route('merchants.show', $merchant) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Открыть
                                        </a>
                                        <a class="btn btn-info btn-sm" href="{{ route('merchants.edit', $merchant) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Редактировать
                                        </a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('merchants.update_token', $merchant) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Обновить токен
                                        </a>
                                        <form action="{{ route('merchants.destroy', $merchant) }}" method="POST"
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
                    <p>Поставщиков пока нет...</p>
                @endif
                </div>
                <!-- /.card-body -->
            </div>


        </div><!-- /.container-fluid -->
        <div class="card-footer clearfix">
            <a type="button" class="btn btn-primary float-right" href="{{ route('merchants.create') }}"><i class="fas fa-plus"></i> Добавить поставщика</a>
        </div>
      </section>
      <!-- /.content -->
@endsection
