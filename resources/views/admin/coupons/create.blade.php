@extends('layouts.admin_layout')
@section('title', 'Добавить купон')
@section('content')
       <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить купон</h1>
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
                        <form role="form" method="POST" action="{{ route('coupons.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Код</label>
                                    <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror"
                                    value="{{ old('code', isset($coupon) ? $coupon->code : null) }}" placeholder="Введите код купона" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Номинал:</label>
                                    <input type="text" name="value" id="value" class="form-control @error('value') is-invalid @enderror"
                                    value="{{ old('value', isset($coupon) ? $coupon->value : null) }}" placeholder="Введите номинал купона" required>
                                </div>
                                <div class="form-group">
                                    <!-- select -->
                                        <div class="form-group">
                                          <label>Валюта</label>
                                            <select name="currency_id" id="currency_id" class="form-control" class="form-control @error('currency_id') is-invalid @enderror">
                                                <option value="">Без валюты</option>
                                                @foreach ($currencies as $currency)
                                                    <option value="{{ $currency->id }}"
                                                        @isset($coupon)
                                                            @if($coupon->currency_id == $currency->id)
                                                            selected
                                                            @endif
                                                        @endisset>
                                                        {{$currency->code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="form-inline">
                                        @foreach ([
                                            'type' => 'Абсолютное значение',
                                            'only_once' => 'Купон может быть использован только один раз'
                                            ] as $field => $title)
                                            <div class="form-check mb-2 mr-sm-2">
                                                <label for="code" class="form-check-label">{{ $title }}: </label>
                                                <div class="ml-2">
                                                    <input class="form-check-input" type="checkbox" name="{{$field}}" id="{{$field}}"
                                                    @if(isset($coupon) && $coupon->$field === 1)
                                                        checked="checked"
                                                    @endif
                                                    >
                                                </div>
                                            </div>
                                        @endforeach
                                </div>
                                <br>
                                <div class="input-group row">
                                    <label for="expired_at" class="col-sm-2 col-form-label">Использовать до: </label>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control" name="expired_at" id="expired_at"
                                            value="{{ old('expired_at', isset($coupon) ? $coupon->expired_at : null) }}">
                                    </div>
                                </div>
                                <br>
                                <div class="input-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                                    <div class="col-sm-6">
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="72" rows="7">{{ old('description', isset($coupon) ? $coupon->description : null) }}</textarea>
                                    </div>
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
