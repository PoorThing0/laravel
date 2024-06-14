@extends('layouts.app')

@section('title-block', 'Каталог')

@section('content')
    <h1>Каталог товаров</h1>
    <div class="products">
        @foreach ($products as $product)
            <div class="product">
                <h2>{{ $product->name }}</h2>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <p>{{ $product->description }}</p>
                <p>Цена: {{ $product->price }}</p>
            </div>
        @endforeach
    </div>
@endsection
