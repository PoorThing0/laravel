@extends('layouts.app')

@section('title-block', 'Каталог')

@section('content')
    <h1>Каталог товаров</h1>
    <div class="row">
        <div class="col-md-3">
            <h4>Фильтр по категориям</h4>
            <ul class="list-group mb-4">
                <li class="list-group-item">
                    <a href="{{ route('catalog.index') }}" class="btn btn-link">Все категории</a>
                </li>
                @foreach($categories as $category)
                    <li class="list-group-item">
                        <a href="{{ route('catalog.index', ['category' => $category->name]) }}" class="btn btn-link">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-9">
            @if($products->isEmpty())
                <p>Нет товаров для отображения.</p>
            @else
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4">
                            <div class="card mb-4" style="min-height: 450px;">
                                <img src="{{ asset('storage/images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: contain;">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <div class="scrollable-description">
                                        <p class="card-text">{{ $product->description }}</p>
                                    </div>
                                    <p class="card-text"><strong>Категория: </strong>{{ $product->category->name }}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <span class="price-text">{{ $product->price }}₽</span>
                                        @auth
                                            <form action="{{ route('cart.add') }}" method="POST" class="mb-0">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn btn-primary btn-sm">Добавить в корзину</button>
                                            </form>
                                        @else
                                            <p class="mb-0">Пожалуйста, <a href="{{ route('login') }}">войдите</a> для добавления товаров в корзину.</p>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
