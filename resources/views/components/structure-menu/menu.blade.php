@props([
    'components' => [],
    'title' => 'Содержание',
    'placeholder' => 'Содержание пустое',
    'simpleMode' => false,
])
@if($simpleMode)
    <div {{ $attributes->merge(['class' => 'structure-menu'])}}>
        @forelse ($components as $link)
            <div class="item"> {!! $link !!}</div>
        @empty
            <div class="item">{{ $placeholder }}</div>
        @endforelse
    </div>
@else
    <div {{ $attributes->merge(['class' => 'structure-menu sticky'])}} style="top: 2rem">
        <div class="text-md mb-6">{{ $title }}</div>
        <div class="box" >
            @forelse ($components as $link)
                <div class="item"> {!! $link !!}</div>
            @empty
                <div class="item">{{ $placeholder }}</div>
            @endforelse
        </div>
    </div>
@endif
