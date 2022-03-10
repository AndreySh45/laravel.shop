@extends('layouts.admin_layout')

@section('title', 'Купон ' . $coupon->code)

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="justify-content-center">
                <div class="panel">
                    <h1>Купон №{{ $coupon->code }}</h1>
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
                                <td>{{ $coupon->id}}</td>
                            </tr>
                            <tr>
                                <td>Код</td>
                                <td>{{ $coupon->code }}</td>
                            </tr>
                            <tr>
                                <td>Описание</td>
                                <td>{{ $coupon->description }}</td>
                            </tr>
                            @isset($coupon->currency)
                                <tr>
                                    <td>Валюта</td>
                                    <td>{{ $coupon->currency->code }}</td>
                                </tr>
                            @endisset
                            <tr>
                                <td>Абсолютное значение</td>
                                <td>@if($coupon->isAbsolute()) Да @else Нет @endif</td>
                            </tr>
                            <tr>
                                <td>Скидка</td>
                                <td>{{ $coupon->value }} @if($coupon->isAbsolute()) {{ $coupon->currency->code }} @else % @endif</td>
                            </tr>
                            <tr>
                                <td>Использовать один раз</td>
                                <td>@if($coupon->isOnlyOnce()) Да @else Нет @endif</td>
                            </tr>
                            <tr>
                                <td>Использован:</td>
                                <td>{{ $coupon->orders->count() }}</td>
                            </tr>
                            @isset($coupon->expired_at)
                                <tr>
                                    <td>Действителен до:</td>
                                    <td>{{ $coupon->expired_at->format('d.m.Y') }}</td>
                                </tr>
                            @endisset
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
