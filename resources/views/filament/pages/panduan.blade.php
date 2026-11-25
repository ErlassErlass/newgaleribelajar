<x-filament-panels::page>
    @php $guide = $this->guide(); @endphp

    <x-filament::section icon="heroicon-o-information-circle" heading="Berlaku untuk semua role">
        <div class="fi-prose max-w-none">{!! $guide['intro'] !!}</div>
    </x-filament::section>

    @foreach($guide['sections'] as $section)
        <x-filament::section
            :icon="$section['own'] ? 'heroicon-o-star' : 'heroicon-o-book-open'"
            :heading="$section['title'].($section['own'] ? ' (role Anda)' : '')"
            :description="$section['own'] ? null : 'Untuk memahami pekerjaan role lain. Klik untuk membuka.'"
            collapsible
            :collapsed="! $section['own']"
        >
            <div class="fi-prose max-w-none">{!! $section['html'] !!}</div>
        </x-filament::section>
    @endforeach

    @if(filled($guide['summary']))
        <x-filament::section icon="heroicon-o-table-cells" heading="Ringkasan hak akses" collapsible collapsed>
            <div class="fi-prose max-w-none overflow-x-auto">{!! $guide['summary'] !!}</div>
        </x-filament::section>
    @endif
</x-filament-panels::page>
