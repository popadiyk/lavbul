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
        <th>Id</th>
        <th>Title</th>
        <th>Group</th>
        <th>Cost</th>
        <th>Count</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->title }}</td>
            <td>{{ $product->group->title }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->description }}</td>
            <td>
                <a href="{{ route('products.show', ['id' => $product->id]) }} ">See</a>
                <a href='#'>To cart</a>
            </td>
        </tr>
    @endforeach
</table>
{{--for pagination link--}}
{{  $products->links()}}
