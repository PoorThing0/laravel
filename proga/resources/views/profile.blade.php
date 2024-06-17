@extends('layouts.app')

@section('title', 'Профиль пользователя')

@section('content')
    <div class="container mt-4">
        <h2>{{ $user->name }} - Профиль</h2>
        <h3>Заказы:</h3>
        @if ($orders->isEmpty())
            <p>У вас пока нет заказов.</p>
        @else
            <ul>
                @foreach ($orders as $order)
                    <li>
                        Заказ №{{ $order->id }}<br>
                        Создан: {{ $order->created_at->format('d.m.Y H:i') }}<br>
                        Статус: {{ $order->status }}<br>
                        Сумма заказа: {{ $order->total_price }} руб.<br>
                        <hr>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
