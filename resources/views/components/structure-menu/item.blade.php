@props([
    'href' => '#',
    'title',
    'description' => null,
    'icon' => null,
])
<a href="{{ $href }}" {{ $attributes->merge(['class' => 'structure-menu-item relative'])}}>
    <div class="flex flex-row">

        @if($icon)
            {!! $icon !!}
        @else
           <div class="w-5 h-5 text-current flex">•</div>
        @endif
            <div>{!! $title !!}</div>
        @if($description)
            <div class="link-group-description">{!! $description !!}</div>
        @endif
    </div>

</a>
