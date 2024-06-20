@extends('layouts.app')

@section('title-block', 'Главная')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center mb-4">Добро пожаловать на главную страницу!</h1>
                
                <div class="text-center">
                    <p class="lead">
                        Узнайте о наших акциях!
                    </p>
                </div>
                
                <div id="carouselExampleControls" class="carousel slide mt-5" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($slides as $key => $slide)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $slide->image) }}" class="d-block w-100" alt="Slide {{ $key + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('catalog.index') }}" class="btn btn-primary mt-3">Перейти в каталог</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myCarousel = document.getElementById('carouselExampleControls');
            new bootstrap.Carousel(myCarousel, {
                interval: 2000,
                wrap: true 
            });
        });
    </script>
@endsection
