@extends('layouts.app')

@section('title-block', 'Административная панель')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Административная панель</h2>

                <a href="{{ route('admin.products') }}" class="btn btn-primary mb-3">Настройка товаров</a>
                <a href="{{ url('/admin/orders') }}" class="btn btn-secondary mb-3">Список заказов</a>
                
                <h3>Список промокодов</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Код</th>
                            <th>Скидка (%)</th>
                            <th>Активен</th>
                            <th>Дата создания</th>
                            <th>Дата обновления</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promoCodes as $promoCode)
                            <tr>
                                <td>{{ $promoCode->id }}</td>
                                <td>{{ $promoCode->code }}</td>
                                <td>{{ $promoCode->discount_percentage }}</td>
                                <td>{{ $promoCode->is_active ? 'Да' : 'Нет' }}</td>
                                <td>{{ $promoCode->created_at }}</td>
                                <td>{{ $promoCode->updated_at }}</td>
                                <td>
                                    <form action="{{ route('admin.promo-codes.destroy', ['id' => $promoCode->id]) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                    </form>
                                    <form action="{{ route('admin.promo-codes.toggle', ['id' => $promoCode->id]) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-secondary btn-sm">
                                            {{ $promoCode->is_active ? 'Деактивировать' : 'Активировать' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>Создать новый промокод</h3>
                <form action="{{ route('admin.promo-codes.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="code">Код:</label>
                        <input type="text" name="code" id="code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="discount_percentage">Скидка (%):</label>
                        <input type="number" name="discount_percentage" id="discount_percentage" class="form-control" min="0" max="100" required>
                    </div>
                    <button type="submit" class="btn btn-success">Создать</button>
                </form>
            </div>
        </div>
    </div>
@endsection
