<!DOCTYPE html>
<html>
<head>
    <title>Your Orders</title>
</head>
<body>
    <h1>Your Orders</h1>
    <ul>
        @foreach ($orders as $order)
            <li>
                <h2>Order ID: {{ $order->id }}</h2>
                <p>Total Price: ${{ $order->total_price }}</p>
                <p>Status: {{ $order->status }}</p>
                <p>Created At: {{ $order->created_at }}</p>
                <p>No Resi: {{ $order->no_resi }}</p>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('home') }}">Continue Shopping</a>
</body>
</html>