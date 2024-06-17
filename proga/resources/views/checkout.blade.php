@extends('layouts.app')

@section('title', 'Оформление заказа')

@section('content')
<div class="container">
    <h2>Оформление заказа</h2>
    <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="user_name">Имя</label>
            <input type="text" id="user_name" name="user_name" class="form-control" value="{{ old('user_name') }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Эл. почта</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label>Тип доставки</label><br>
            <input type="radio" id="pickup" name="delivery_type" value="pickup" {{ old('delivery_type') === 'pickup' ? 'checked' : '' }}>
            <label for="pickup">Самовывоз</label>
            <input type="radio" id="delivery" name="delivery_type" value="delivery" {{ old('delivery_type') === 'delivery' ? 'checked' : '' }}>
            <label for="delivery">Доставка</label>
        </div>

        <div class="form-group" id="delivery-address-group" style="{{ old('delivery_type') === 'delivery' ? 'display: block;' : 'display: none;' }}">
            <label for="delivery_address">Адрес доставки</label>
            <input type="text" id="delivery_address" name="delivery_address" class="form-control" value="{{ old('delivery_address') }}">
            @error('delivery_address')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div id="map" style="height: 400px;"></div>
        </div>

        @error('cart')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Оформить заказ</button>
    </form>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deliveryTypeRadios = document.getElementsByName('delivery_type');
        const deliveryAddressGroup = document.getElementById('delivery-address-group');
        let map;

        for (const radio of deliveryTypeRadios) {
            radio.addEventListener('change', function () {
                if (this.value === 'delivery') {
                    deliveryAddressGroup.style.display = 'block';

                    if (!map) {
                        map = L.map('map').setView([55.751244, 37.618423], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                        }).addTo(map);

                        let marker;

                        map.on('click', function (e) {
                            if (marker) {
                                map.removeLayer(marker);
                            }
                            marker = L.marker(e.latlng).addTo(map);
                            updateAddressFromCoordinates(e.latlng.lat, e.latlng.lng);
                        });
                    }
                } else {
                    deliveryAddressGroup.style.display = 'none';
                }
            });
        }
    });

    function updateAddressFromCoordinates(latitude, longitude) {
        const url = `https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=jsonv2`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.display_name) {
                    document.getElementById('delivery_address').value = data.display_name;
                } else {
                    console.error('Address not found for coordinates:', latitude, longitude);
                }
            })
            .catch(error => console.error('Error fetching address:', error));
    }
</script>
@endsection
