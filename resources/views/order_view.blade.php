@extends('layouts.app')
@section('title', "View Order")
@section('content')

<h3>View Order <span class="badge bg-secondary">{{ $order->status}}</span></h3>

<br>

<table class="table">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Quantity</th>
        </tr>
    </thead>
    <tbody id="catalogue">

        @forelse ($order_details as $order)
        <tr>
            <td>{{ $order->product_id }}</td>
            <td><img height="100px" src="{{ $order->img }}"></td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->quantity }}</td>
        </tr>
            
        @empty
        <tr>
            <td>Empty</td>
        </tr>
        @endforelse

    </tbody>
    
</table>

@endsection

  
@section('script')


@endsection

