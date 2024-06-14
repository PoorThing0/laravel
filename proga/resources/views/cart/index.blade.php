@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Ваша корзина</h2>
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
                            <!-- Форма для обновления количества товара -->
                            <form action="{{ route('cart.update', ['id' => $cartItem->id]) }}" method="POST" class="d-flex">
                                @csrf
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" class="form-control mr-2" style="width: 80px;">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </form>
                        </td>
                        <td>{{ $cartItem->product->price * $cartItem->quantity }}₽</td>
                        <td>
                            <!-- Кнопка для удаления товара из корзины -->
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
                        <td><strong>{{ $totalPrice }}₽</strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
