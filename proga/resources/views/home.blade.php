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

                <div class="text-center">
                    <a href="{{ route('catalog.index') }}" class="btn btn-primary mt-3">Перейти в каталог</a>
                </div>
            </div>
        </div>
    <div class="fixed-bottom text-center mb-3">
        <button id="show-video-btn" class="btn btn-link btn-small-video" data-bs-toggle="modal" data-bs-target="#videoModal" title="Устроиться к нам">
            ?
        </button>
    </div>
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Устроиться к нам</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="video-container">
                        <iframe id="videoFrame" class="embed-responsive-item" src="https://www.youtube.com/embed/ueCUtaN5144" allowfullscreen width=750px height=400px></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var videoModal = document.getElementById('videoModal');
            var videoFrame = document.getElementById('videoFrame');

            videoModal.addEventListener('hidden.bs.modal', function () {
                videoFrame.src = "";
            });

            videoModal.addEventListener('show.bs.modal', function () {
                videoFrame.src = "https://www.youtube.com/embed/ueCUtaN5144";
            });
        });
    </script>
@endsection
