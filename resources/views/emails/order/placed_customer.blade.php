@component('mail::message')

Ваш заказ был успешно оформлен.

**Детали заказа:**
- Имя: {{ $order->user_name }}
- Телефон: {{ $order->phone }}
- Эл. почта: {{ $order->email }}
- Тип доставки: {{ $order->delivery_type }}
@if ($order->delivery_type === 'delivery')
- Адрес доставки: {{ $order->delivery_address }}
@endif
- Общая стоимость: {{ $order->total_price }}

Спасибо за покупку!

@endcomponent
