@extends('layouts.app')

@section('title', 'Создание заказа')

@section('content')
<div class="container">
    <h2>Создание заказа</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="user_name">Имя</label>
            <input type="text" id="user_name" name="user_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Эл. почта</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Тип доставки</label><br>
            <input type="radio" id="pickup" name="delivery_type" value="pickup" checked>
            <label for="pickup">Самовывоз</label>
            <input type="radio" id="delivery" name="delivery_type" value="delivery">
            <label for="delivery">Доставка</label>
        </div>

        <div class="form-group" id="delivery-address-group" style="display: none;">
            <label for="delivery_address">Адрес доставки</label>
            <input type="text" id="delivery_address" name="delivery_address" class="form-control">
            <div id="map" style="height: 400px;"></div>
            @error('delivery_address')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Оформить заказ</button>
    </form>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
<script>
    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: { lat: 55.751244, lng: 37.618423 }
        });

        let marker;

        map.addListener("click", (event) => {
            if (marker) {
                marker.setMap(null);
            }
            marker = new google.maps.Marker({
                position: event.latLng,
                map: map
            });

            document.getElementById('delivery_address').value = `${event.latLng.lat()},${event.latLng.lng()}`;
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const deliveryTypeRadios = document.getElementsByName('delivery_type');
        const deliveryAddressGroup = document.getElementById('delivery-address-group');

        for (const radio of deliveryTypeRadios) {
            radio.addEventListener('change', function () {
                if (this.value === 'delivery') {
                    deliveryAddressGroup.style.display = 'block';
                } else {
                    deliveryAddressGroup.style.display = 'none';
                }
            });
        }
    });
</script>
@endsection
