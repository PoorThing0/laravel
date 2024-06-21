@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Регистрация курьера') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('courier.register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Имя') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Пароль') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Подтвердите пароль') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">{{ __('Зарегистрироваться') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
