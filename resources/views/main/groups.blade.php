@foreach ($items as $item)
<dt>
  <a href="#accordion1" aria-expanded="false" aria-controls="accordion1" class=" btn accordion-title accordionTitle js-accordionTrigger btn-default waves-effect waves-light {{ ($loop->depth > 2) ? "last" : "" }}" groupId="{{ $item->id }}">{{ $item->title }}</a>
</dt>
<dd class="accordion-content accordionItem is-collapsed" id="accordion1" aria-hidden="true">
    @if (isset($elements[$item->id]))
      <dl class="inner-item">
        @include('main.groups', ['items' => $elements[$item->id]])
      </dl>
    @endif
</dd>
@endforeach