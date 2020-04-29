@extends('layouts.app')

@section('content')
    <h3>Checkout</h3>

    <form action="{{route('orders.store')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="">Full Name</label>
          <input type="text" name="shipping_fullname" id="" class="form-control" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Province</label>
            <input type="text" name="shipping_province" id="" class="form-control" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Location</label>
            <input type="text" name="shipping_location" id="" class="form-control" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Zipcode</label>
            <input type="text" name="shipping_zipcode" id="" class="form-control" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Full Address</label>
            <input type="text" name="shipping_address" id="" class="form-control" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Mobile</label>
            <input type="text" name="shipping_phone" id="" class="form-control" placeholder="">
        </div>

        <h4>Payment options</h4>
        <div class="form-check">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" name="payment_method" id="" value="cash_on_delivery">
            Cash on delivery
          </label>
        </div>

        <div class="form-check">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" name="payment_method" id="" value="paypal">
            PayPal
          </label>
        </div>

        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
@endsection
