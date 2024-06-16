<!-- resources/views/admin/index.blade.php -->

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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
