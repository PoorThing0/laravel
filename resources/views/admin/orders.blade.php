@extends('layouts.app')

@section('title-block', 'Список заказов')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Список заказов</h2>

                <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Назад</a>
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
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Изменить статус</th>
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
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#statusModal{{ $order->id }}">
                                        Изменить
                                    </button>
                                    <div class="modal fade" id="statusModal{{ $order->id }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $order->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="statusModalLabel{{ $order->id }}">Изменить статус заказа #{{ $order->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="status{{ $order->id }}" class="form-label">Статус</label>
                                                            <select name="status" id="status{{ $order->id }}" class="form-select">
                                                                <option value="оформлен" {{ $order->status == 'оформлен' ? 'selected' : '' }}>оформлен</option>
                                                                <option value="принят" {{ $order->status == 'принят' ? 'selected' : '' }}>принят</option>
                                                                <option value="доставляется" {{ $order->status == 'доставляется' ? 'selected' : '' }}>доставляется</option>
                                                                <option value="завершен" {{ $order->status == 'завершен' ? 'selected' : '' }}>завершен</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
