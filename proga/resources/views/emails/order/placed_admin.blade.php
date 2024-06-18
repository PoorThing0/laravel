@component('mail::message')
# Новый заказ оформлен

Был оформлен новый заказ на сайте.

**Детали заказа:**
- Имя клиента: {{ $order->user_name }}
- Телефон: {{ $order->phone }}
- Эл. почта: {{ $order->email }}
- Тип доставки: {{ $order->delivery_type }}
@if ($order->delivery_type === 'delivery')
- Адрес доставки: {{ $order->delivery_address }}
@endif
- Общая стоимость: {{ $order->total_price }}

Пожалуйста, обработайте этот заказ как можно скорее.

@endcomponent
