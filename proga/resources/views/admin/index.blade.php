@extends('layouts.app')

@section('title', 'Административная панель')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Административная панель</h2>
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
                                <td>
                                    @if($promoCode->is_active)
                                        <span class="badge badge-success">Активен</span>
                                    @else
                                        <span class="badge badge-secondary">Неактивен</span>
                                    @endif
                                </td>
                                <td>{{ $promoCode->created_at }}</td>
                                <td>{{ $promoCode->updated_at }}</td>
                                <td>
                                    <form action="{{ route('admin.promo-codes.toggle', $promoCode->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $promoCode->is_active ? 'btn-warning' : 'btn-success' }}">
                                            {{ $promoCode->is_active ? 'Деактивировать' : 'Активировать' }}
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.promo-codes.destroy', $promoCode->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот промокод?')">Удалить</button>
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
