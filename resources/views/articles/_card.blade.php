<article class="group bg-white rounded-2xl border {{ $article->is_pinned ? 'border-[#fb8500]/60' : 'border-slate-200/80' }} overflow-hidden shadow-xs hover:shadow-lg hover:-translate-y-1 transition-all flex flex-col">
    <a href="{{ route('articles.show', $article->slug) }}" class="block aspect-[16/10] overflow-hidden bg-slate-100">
        @if($article->cover_image)
        <img src="{{ asset($article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
        @endif
    </a>
    <div class="p-6 flex flex-col flex-1">
        <div class="flex flex-wrap items-center gap-2 text-[11px] font-semibold mb-3">
            @if($article->is_pinned)
            @include('articles._pin-badge')
            @endif
            <span class="px-2.5 py-1 rounded-md bg-[#8ecae6]/20 text-[#023047] uppercase tracking-wider">{{ __($article->category_label) }}</span>
            @if($article->published_at)
            <time datetime="{{ $article->published_at->toDateString() }}" class="text-slate-500">{{ $article->published_at->translatedFormat('d M Y') }}</time>
            @endif
            <span class="text-slate-400" title="{{ __('Jumlah dilihat') }}">· {{ number_format($article->views, 0, ',', '.') }}× {{ __('dilihat') }}</span>
        </div>
        <h3 class="text-lg font-bold text-[#023047] leading-snug mb-2">
            <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-[#219ebc]">{{ $article->title }}</a>
        </h3>
        <p class="text-sm text-slate-600 leading-relaxed line-clamp-3 mb-4">{{ $article->excerpt }}</p>
        @if(!empty($article->tags))
        <div class="flex flex-wrap gap-x-3 gap-y-1 mb-5">
            @foreach(array_slice($article->tags, 0, 3) as $tag)
            <a href="{{ route('articles.index', ['tag' => $tag]) }}" rel="tag" class="text-xs font-semibold text-[#219ebc] hover:text-[#023047]">#{{ $tag }}</a>
            @endforeach
        </div>
        @endif
        <a href="{{ route('articles.show', $article->slug) }}" class="mt-auto text-sm font-bold text-[#219ebc] hover:text-[#023047]">{{ __('Baca Selengkapnya →') }}</a>
    </div>
</article>
