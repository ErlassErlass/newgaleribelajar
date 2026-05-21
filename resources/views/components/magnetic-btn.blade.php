@props(['href' => '#', 'class' => ''])

<a href="{{ $href }}" class="x-magnetic-btn inline-block {{ $class }}">
    <span class="magnetic-inner inline-flex items-center justify-center w-full h-full pointer-events-none">
        {{ $slot }}
    </span>
</a>
