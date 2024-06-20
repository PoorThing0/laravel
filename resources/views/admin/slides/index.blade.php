@extends('layouts.app')

@section('title-block', 'Управление слайдами')

@section('content')
    <div class="container">
        <h1>Управление слайдами</h1>
        <a href="{{ route('admin.slides.create') }}" class="btn btn-primary mb-4">Добавить слайд</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row">
            @foreach($slides as $slide)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $slide->image) }}" class="card-img-top" alt="Slide Image">
                        <div class="card-body">
                            @if($slide->link)
                                <a href="{{ $slide->link }}" target="_blank" class="btn btn-link">Перейти по ссылке</a>
                            @endif
                            <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
