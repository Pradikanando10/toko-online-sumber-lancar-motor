<!DOCTYPE html>
<html>
<head>
    <title>Admin Orders</title>
</head>
<body>
    <h1>All Orders</h1>
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <ul>
        @foreach ($orders as $order)
            <li>
                <h2>Order ID: {{ $order->id }}</h2>
                <p>User ID: {{ $order->user_id }}</p>
                <p>Total Price: Rp {{ $order->total_price }}</p>
                <p>Status: {{ $order->status }}</p>
                <p>Created At: {{ $order->created_at }}</p>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <button type="submit">Update Status</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>