@extends('layouts.app')

@section('title-block', 'Каталог')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Каталог товаров</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Фильтр по категориям</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('catalog.index') }}" class="btn btn-link btn-block">Все категории</a>
                            </li>
                            @foreach($categories as $category)
                                <li class="list-group-item">
                                    <a href="{{ route('catalog.index', ['category' => $category->name]) }}" class="btn btn-link btn-block">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="{{ asset('storage/images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: contain;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <p class="card-text"><strong>Категория: </strong>{{ $product->category->name }}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="price-text">{{ $product->price }}₽</span>
                                        @auth
                                            <form action="{{ route('cart.add') }}" method="POST">
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
                    @empty
                        <div class="col-md-12">
                            <p class="text-center">Нет товаров для отображения.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
