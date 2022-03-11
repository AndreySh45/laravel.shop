@extends('layouts.admin_layout')

@section('title', 'Поставщик ' . $merchant->name)

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="justify-content-center">
                <div class="panel">
                    <h1>Поставщик: {{ $merchant->name }}</h1>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Поле</th>
                                <th>Значение</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $merchant->id }}</td>
                            </tr>
                            <tr>
                                <td>Название</td>
                                <td>{{ $merchant->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $merchant->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
