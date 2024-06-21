@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Курьерский вход') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('courier.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Пароль') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">{{ __('Войти') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
