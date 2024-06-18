@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Ваша корзина</h2>

            @if ($errors->has('promo_code'))
                <div class="alert alert-danger">
                    {{ $errors->first('promo_code') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Наименование</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Количество</th>
                        <th scope="col">Сумма</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $index => $cartItem)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $cartItem->product->name }}</td>
                        <td>{{ $cartItem->product->price }}₽</td>
                        <td>
                            <form action="{{ route('cart.update', ['id' => $cartItem->id]) }}" method="POST" class="d-flex">
                                @csrf
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" class="form-control mr-2" style="width: 80px;">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </form>
                        </td>
                        <td>{{ $cartItem->product->price * $cartItem->quantity }}₽</td>
                        <td>
                            <form action="{{ route('cart.delete', ['id' => $cartItem->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><strong>Общая стоимость</strong></td>
                        <td><strong>{{ number_format($totalPrice, 2) }}₽</strong></td>
                        <td></td>
                    </tr>
                    @if(isset($promo_applied) && $promo_applied)
                    <tr>
                        <td colspan="4"><strong>Скидка ({{ $discount }}%)</strong></td>
                        <td><strong>{{ number_format($discountAmount, 2) }}₽</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Итоговая стоимость</strong></td>
                        <td><strong>{{ number_format($finalPrice, 2) }}₽</strong></td>
                        <td></td>
                    </tr>
                    @endif
                </tfoot>
            </table>

            <form action="{{ route('cart.apply-promo') }}" method="POST" class="d-flex mt-3">
                @csrf
                <input type="text" name="promo_code" class="form-control" placeholder="Введите промокод">
                <button type="submit" class="btn btn-success ml-2">Применить промокод</button>
            </form>

            <button class="btn btn-primary mt-3"><a href="{{ route('checkout') }}" class="btn btn-primary mt-3">Оформить заказ</a>
            </button>
        </div>
    </div>
</div>
@endsection
