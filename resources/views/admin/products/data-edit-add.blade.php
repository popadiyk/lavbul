<table id="dataTable" class="table table-hover">
    <thead>
    <tr>
        <th>Код</th>
        <th>Назва</th>
        <th>Група</th>
        <th>Постачальник</th>
        <th>Залишок</th>
        <th>Ціна</th>
        <th>Фото</th>
        <th class="actions"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $data)
        <tr style="text-align: center;">
            <td>{{$data->marking}}</td>
            <td style="text-align: left; width: 300px;">{{$data->title}}</td>
            <td>{{$data->group->title}}</td>
            <td>{{$data->manufacture->title}}</td>
            <td>{{$data->quantity}}</td>
            <td>{{$data->price}}</td>
            <td>
                <img src="{{$data->main_photo}}" alt="{{$data->title}}" style="width:100px">
            </td>
            <td class="no-sort no-click">
                @if (Voyager::can('delete_'.$dataType->name))
                    <a title="Видалити" class="btn btn-danger delete" data-id="{{ $data->id }}" id="delete-{{ $data->id }}">
                        <i class="voyager-trash"></i>
                    </a>
                @endif
                @if (Voyager::can('edit_'.$dataType->name))
                    <a title="Змінити" href="{{ route('voyager.'.$dataType->slug.'.edit', $data->id) }}" class="btn btn-primary edit">
                        <i class="voyager-edit"></i>
                    </a>
                @endif
                <br>
                @if (Voyager::can('read_'.$dataType->name))
                    <a title="Перегляд" style="margin-left: 5px; margin-right: 0px;" href="{{ route('voyager.'.$dataType->slug.'.show', $data->id) }}" class="btn btn-warning">
                        <i class="voyager-eye"></i>
                    </a>
                @endif
                @if ($data->isMain() == false)
                    <a title="На головну" style="margin-left: 5px; margin-right: 2px;" class="btn btn-success gotomain" act="add" dataid = "{{$data->id}}" onclick="gotomain(this)">
                        <i class="voyager-angle-right"></i>
                    </a>
                @else
                    <a title="З головної" style="background: green; margin-left: 5px; margin-right: 2px;" class="btn btn-success gotomain" act="del" dataid = "{{$data->id}}" onclick="gotomain(this)">
                        <i class="voyager-angle-left"></i>
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{--<div class="panel-body">--}}

    {{--@if (isset($dataType->server_side) && $dataType->server_side)--}}
        {{--<div class="pull-left">--}}
            {{--<div role="status" class="show-res" aria-live="polite">Showing {{ $dataTypeContent->firstItem() }} to {{ $dataTypeContent->lastItem() }} of {{ $dataTypeContent->total() }} entries</div>--}}
        {{--</div>--}}
        {{--<div class="pull-right">--}}
            {{--{{ $dataTypeContent->links() }}--}}
        {{--</div>--}}
    {{--@endif--}}
{{--</div>--}}

{!! $products->render() !!}

<script>

</script>