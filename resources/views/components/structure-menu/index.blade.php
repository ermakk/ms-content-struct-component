@props([
    'components' => [],
    'link' => null,
])

<div class="item"> {!! $link !!}</div>
<div {{ $attributes->merge(['class' => 'structure-menu'])}} style="margin-left: 2rem">
    @foreach($components as $item)
        <div class="item my-2"> {!! $item !!}</div>
    @endforeach
</div>
