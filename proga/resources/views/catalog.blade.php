@extends('layouts.app')

@section('title-block', 'Каталог')

@section('content')
    <h1>Каталог товаров</h1>
    @if($products->isEmpty())
        <p>Нет товаров для отображения.</p>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-2">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Цена: </strong>{{ $product->price }}₽</p>
                            <p class="card-text"><strong>Категория: </strong>{{ $product->category->name }}</p>
                            @auth
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary">Добавить в корзину</button>
                                </form>
                            @else
                                <p>Пожалуйста, <a href="{{ route('login') }}">войдите</a> для добавления товаров в корзину.</p>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection