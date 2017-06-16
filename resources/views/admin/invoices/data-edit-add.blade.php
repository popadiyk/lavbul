<table id="dataTable" class="table table-hover" style="font-size: 11px; border: #EAEAEA solid 1px;">
    <thead>
    <tr>
        <th>Код</th>
        <th>Назва</th>
        <th>Група</th>
        <th>Постачальник</th>
        <th>Залишок</th>
        <th>Ціна</th>
        <th>Фото</th>
    </tr>
    </thead>
    <tbody >
    @foreach($products as $data)
        <tr marking = "{{$data->marking}}"
            maxqty = "{{$data->quantity}}"
            title = "{{$data->title}}"
            price = "{{$data->price}}"
            purchaseprice = "{{$data->purchase_price}}"
            style="text-align: center;">
            <td>{{$data->marking}}</td>
            <td style="text-align: left; width: 300px;">{{$data->title}}</td>
            <td>{{$data->group->title}}</td>
            <td>{{$data->manufacture->title}}</td>
            <td>{{$data->quantity}}</td>
            <td>{{$data->price}}</td>
            <td>
                <img src="{{$data->main_photo}}" alt="{{$data->title}}" style="width:100px">
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{!! $products->render() !!}

<script>

</script>