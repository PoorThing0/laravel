@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    <h1>Корзина</h1>

    @if ($cartItems->isEmpty())
        <p>Ваша корзина пуста.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $cartItem)
                    <tr>
                        <td>{{ $cartItem->product->name }}</td>
                        <td>{{ $cartItem->product->price }}₽</td>
                        <td>
                        <form action="{{ route('cart.updateQuantity', ['id' => $cartItem->id]) }}" method="post">
                            @csrf
                            @method('post')
                            <input type="number" name="quantity" value="{{ $cartItem->quantity }}">
                            <button type="submit">Обновить</button>
                        </form>
                        </td>
                        <td>{{ $cartItem->product->price * $cartItem->quantity }}₽</td>
                        <td>
                            <form action="{{ route('cart.delete', ['id' => $cartItem->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Общая стоимость</strong></td>
                    <td><strong>{{ $totalPrice }}₽</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    @endif
@endsection
