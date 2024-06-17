@extends('layouts.app')

@section('title', 'Список заказов')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Список заказов</h2>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя пользователя</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Адрес доставки</th>
                            <th>Сумма заказа</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user_name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->delivery_address }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
