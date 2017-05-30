<style>
    table#t01 tr:nth-child(even) {
        background-color: #eee;
    }
    table#t01 tr:nth-child(odd) {
        background-color: #fff;
    }
    table#t01 th {
        color: white;
        background-color: black;
    }
</style>


<table id="t01">
    <tr>
        <th>Id row</th>
        <th>Id pruduct</th>
        <th>Title product</th>
        <th>Count</th>
        <th>Cost</th>
        <th>Action</th>
    </tr>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->product->id }}</td>
            <td>{{ $order->product->title }}</td>
            <td>{{ $order->product->count }}</td>
            <td>{{ $order->product->count * $order->product->price }}</td>
            <td>
                <a href='#'>Delete</a>
            </td>
        </tr>
    @endforeach
</table>

{{--for pagination link--}}
{{  $products->links()}}