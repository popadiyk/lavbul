<ul>
    @foreach($categories as $category)
        <li style="list-style-type: none;" class="dd-handle">{{ $category->title }}
            @if (Voyager::can('delete_'.$dataType->name))
                <div style="margin-top: -5px;" class="btn-sm btn-danger pull-right delete" data-id="{{ $category->id }}" id="delete-{{ $category->id }}">
                    <i class="voyager-trash"></i> Delete
                </div>
            @endif
            @if (Voyager::can('edit_'.$dataType->name))
                <a style="margin-top: -5px;" href="{{ route('voyager.'.$dataType->slug.'.edit', $category->id) }}" class="btn-sm btn-primary pull-right edit">
                    <i class="voyager-edit"></i> Edit
                </a>
            @endif
        </li>
        @if($category->ProductCategory->count() > 0)
            @include('admin.groups.partials.treeChildMenu', ['categories' => $category->ProductCategory])
        @endif
    @endforeach
</ul>