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
            <div class="carousel-item active">
                <a href="http://127.0.0.1:8000/catalog?category=Пицца"><img src="{{ asset('storage/images/slid1.jpg') }}" class="d-block w-100" alt="Slide 1"></a>
            </div>
            <div class="carousel-item">
                <a href="http://127.0.0.1:8000/catalog?category=Сеты"><img src="{{ asset('storage/images/slid2.jpg') }}" class="d-block w-100" alt="..."></a>
            </div>
            <div class="carousel-item">
                <a href="https://youtu.be/ueCUtaN5144"><img src="{{ asset('storage/images/slid3.jpg') }}" class="d-block w-100" alt="..."></a>
            </div>
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

