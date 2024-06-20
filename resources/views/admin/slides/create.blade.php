@extends('layouts.app')

@section('title-block', 'Добавить слайд')

@section('content')
    <div class="container">
        <h1>Добавить слайд</h1>
        <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Изображение</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="link">Ссылка</label>
                <input type="url" name="link" id="link" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
    </div>
@endsection
