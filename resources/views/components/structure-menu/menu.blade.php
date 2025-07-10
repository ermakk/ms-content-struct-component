@props([
    'components' => [],
    'title' => 'Содержание',
    'placeholder' => 'Содержание пустое',
    'simpleMode' => false,
])
<div {{ $attributes->merge(['class' => 'structure-menu'])}}>
    @if($simpleMode)
        @forelse ($components as $link)
            <div class="item"> {!! $link !!}</div>
        @empty
            <div class="item">{{ $placeholder }}</div>
        @endforelse
    @else
        <div class="text-md mb-6">{{ $title }}</div>
        <div class="box" >
            @forelse ($components as $link)
                <div class="item"> {!! $link !!}</div>
            @empty
                <div class="item">{{ $placeholder }}</div>
            @endforelse
        </div>
   @endif
</div>
