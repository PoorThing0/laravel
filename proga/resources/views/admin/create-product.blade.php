@extends('layouts.app')

@section('title', 'Добавить новый товар')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Добавить новый товар</h2>

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Название:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание:</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Категория:</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Цена:</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Фото:</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                    </div>
                    <button type="submit" class="btn btn-primary">Создать товар</button>
                </form>
            </div>
        </div>
    </div>
@endsection
