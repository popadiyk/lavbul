

<h1>this is cabinet</h1>
<table>
    <tr>
        <th>Order Id</th>
        <th>Date</th>
        <th>Status Order</th>
        <th>Invoice</th>
    </tr>
    @foreach($orders as $order)
       <tr>
           <td>{{ $order->id }}</td>
           <td>{{ $order->created_at }}</td>
           <td>{{ $order->status->title }}</td>
           <td>
               <a href="{{ url('invoices/generatePdf/'.$order->invoice_id)}}">Generate Invoice</a>
           </td>
       </tr>

    @endforeach
</table>


