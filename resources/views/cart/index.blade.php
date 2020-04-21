@extends('layouts.app')

@section('content')

    <h2>Your cart</h2>


    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
            <tr>
                <td scope="row">{{$item->name}}</td>
                <td>$ {{$item->price}}</td>
                <td>
                    <form action="{{route('cart.update', $item->id)}}">
                        <select class="form-control" name="quantity">
                        <option value="{{$item->quantity}}" selected hidden>{{$item->quantity}}</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        </select>
                        <input type="submit" value="save">
                    </form>
                </td>
                <td>
                    <a href="{{route('cart.destroy', $item->id)}}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total price: ${{Cart::session(auth()->id())->getTotal()}}</h3>
    <a class="btn btn-primary" href="{{route('cart.checkout')}}" role="button">Proceed to checkout</a>


@endsection
