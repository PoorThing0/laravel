@extends('layouts.app')

@section('title-block', 'Текущие заказы')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Текущие заказы</h2>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя пользователя</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Адрес доставки</th>
                        <th>Сумма заказа</th>
                        <th>Дата создания</th>
                        <th>Дата обновления</th>
                        <th>Отметить как доставлен</th>
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
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>
                                <form action="{{ route('courier.orders.delivered', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Отметить как доставлен</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
