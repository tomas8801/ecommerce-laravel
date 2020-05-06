@component('mail::message')
# Introduction

Thanks for you purchase.

<table class="table">
    <thead>
        <tr>
            <th>Product name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->pivot->quantity}}</td>
            <td>{{$item->pivot->price}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
