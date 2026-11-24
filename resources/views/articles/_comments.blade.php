{{-- Comments: list (one level of replies) + form. Expects $article, $comments, $commentCount. --}}
@php $cErr = $errors->comment; @endphp
<section id="comments" class="mb-16 scroll-mt-28" aria-labelledby="comments-title">
    <div class="flex items-center justify-between gap-4 mb-6">
        <h2 id="comments-title" class="text-xl sm:text-2xl font-extrabold text-[#023047]">
            Komentar <span class="text-slate-400 font-bold">({{ $commentCount }})</span>
        </h2>
        @if($commentCount > 0)
        <a href="#comment-form" class="text-sm font-bold text-[#219ebc] hover:text-[#023047]">Tulis komentar ↓</a>
        @endif
    </div>

    @if(session('comment_success'))
    <div class="mb-6 flex items-start gap-3 rounded-2xl bg-emerald-50 border border-emerald-200 px-5 py-4 text-sm font-semibold text-emerald-800" role="status">
        <svg class="w-5 h-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        {{ session('comment_success') }}
    </div>
    @endif

    {{-- List --}}
    @if($comments->isEmpty())
        <div class="mb-8 rounded-2xl border border-dashed border-slate-300 bg-white/60 px-6 py-8 text-center">
            <p class="text-slate-600 font-semibold">Belum ada komentar.</p>
            <p class="text-sm text-slate-500 mt-1">Jadilah yang pertama berbagi pendapat atau pertanyaan.</p>
        </div>
    @else
        <ol class="space-y-5 mb-10">
            @foreach($comments as $comment)
            <li id="comment-{{ $comment->id }}" class="scroll-mt-28">
                <div class="flex gap-3 sm:gap-4">
                    <div class="shrink-0 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-gradient-to-br from-[#219ebc] to-[#023047] text-white font-bold text-sm flex items-center justify-center" aria-hidden="true">{{ $comment->initials }}</div>
                    <div class="flex-1 min-w-0">
                        <div class="rounded-2xl rounded-tl-sm bg-white border border-slate-200 px-4 sm:px-5 py-3 sm:py-4">
                            <div class="flex flex-wrap items-baseline gap-x-2">
                                <span class="font-bold text-[#023047]">{{ $comment->name }}</span>
                                <time datetime="{{ $comment->created_at->toAtomString() }}" title="{{ $comment->created_at->translatedFormat('d F Y, H:i') }}" class="text-xs text-slate-400">{{ $comment->created_at->diffForHumans() }}</time>
                            </div>
                            <p class="mt-1.5 text-slate-700 text-sm sm:text-base leading-relaxed whitespace-pre-line break-words">{{ $comment->body }}</p>
                        </div>
                        <button type="button" class="js-reply mt-1.5 ml-2 text-xs font-bold text-slate-500 hover:text-[#219ebc]" data-id="{{ $comment->id }}" data-name="{{ $comment->name }}">Balas</button>

                        @if($comment->replies->isNotEmpty())
                        <ol class="mt-3 space-y-3 pl-2 sm:pl-4 border-l-2 border-[#8ecae6]/40">
                            @foreach($comment->replies as $reply)
                            <li id="comment-{{ $reply->id }}" class="flex gap-3 pl-3 scroll-mt-28">
                                <div class="shrink-0 w-8 h-8 rounded-full bg-[#ffb703]/30 text-[#023047] font-bold text-xs flex items-center justify-center" aria-hidden="true">{{ $reply->initials }}</div>
                                <div class="flex-1 min-w-0 rounded-2xl rounded-tl-sm bg-slate-50 border border-slate-200 px-4 py-3">
                                    <div class="flex flex-wrap items-baseline gap-x-2">
                                        <span class="font-bold text-[#023047] text-sm">{{ $reply->name }}</span>
                                        <time datetime="{{ $reply->created_at->toAtomString() }}" class="text-xs text-slate-400">{{ $reply->created_at->diffForHumans() }}</time>
                                    </div>
                                    <p class="mt-1 text-slate-700 text-sm leading-relaxed whitespace-pre-line break-words">{{ $reply->body }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ol>
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
        </ol>
    @endif

    {{-- Form --}}
    <form id="comment-form" action="{{ route('articles.comments.store', $article->slug) }}" method="POST" class="scroll-mt-28 rounded-2xl bg-white border border-slate-200 p-5 sm:p-6 shadow-sm space-y-4" novalidate>
        @csrf
        <input type="hidden" name="parent_id" id="comment-parent" value="{{ $cErr->any() ? old('parent_id') : '' }}">
        <div class="hidden" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>

        <div class="flex items-center justify-between gap-3">
            <h3 class="font-bold text-[#023047]">Tulis Komentar</h3>
            <div id="reply-indicator" class="hidden items-center gap-2 text-xs font-semibold text-[#219ebc] bg-[#8ecae6]/20 rounded-full pl-3 pr-1 py-1">
                <span>Membalas <span id="reply-name"></span></span>
                <button type="button" id="reply-cancel" class="w-5 h-5 rounded-full hover:bg-white flex items-center justify-center" aria-label="Batal membalas">✕</button>
            </div>
        </div>

        @if($cErr->any())
        <div class="rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700" role="alert">
            <ul class="list-disc pl-5 space-y-0.5">
                @foreach($cErr->all() as $msg)<li>{{ $msg }}</li>@endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="comment-name" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-1.5">Nama <span class="text-red-500">*</span></label>
                <input id="comment-name" name="name" type="text" required maxlength="100" autocomplete="name" value="{{ $cErr->any() ? old('name') : '' }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc] outline-none">
            </div>
            <div>
                <label for="comment-email" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-1.5">Email <span class="text-red-500">*</span></label>
                <input id="comment-email" name="email" type="email" required autocomplete="email" value="{{ $cErr->any() ? old('email') : '' }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc] outline-none">
                <p class="text-[11px] text-slate-500 mt-1">Tidak akan ditampilkan.</p>
            </div>
        </div>
        <div>
            <label for="comment-body" class="block text-xs font-bold text-[#023047] uppercase tracking-wider mb-1.5">Komentar <span class="text-red-500">*</span></label>
            <textarea id="comment-body" name="body" rows="4" required maxlength="2000" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm focus:border-[#219ebc] focus:ring-1 focus:ring-[#219ebc] outline-none resize-y" placeholder="Tulis pendapat, pertanyaan, atau pengalaman Anda...">{{ $cErr->any() ? old('body') : '' }}</textarea>
            <div class="flex justify-end"><span class="js-count text-[11px] text-slate-400 tabular-nums">0/2000</span></div>
        </div>
        <label class="flex items-start gap-2.5 text-xs text-slate-600 cursor-pointer">
            <input type="checkbox" name="marketing_consent" value="1" @checked($cErr->any() && old('marketing_consent')) class="mt-0.5 w-4 h-4 rounded border-slate-300 text-[#219ebc] focus:ring-[#219ebc]">
            <span>Saya bersedia menerima info program, promo, dan kegiatan Erlass Academy melalui email. <span class="text-slate-400">(opsional, bisa berhenti kapan saja)</span></span>
        </label>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <p class="text-xs text-slate-500">Mohon berkomentar dengan sopan. Komentar yang mengandung spam atau SARA akan dihapus.</p>
            <button type="submit" class="shrink-0 px-6 py-3 rounded-xl bg-[#fb8500] hover:bg-[#e07600] text-white font-bold text-sm shadow-md transition-colors">Kirim Komentar</button>
        </div>
    </form>
</section>

<script>
    (function () {
        const form = document.getElementById('comment-form');
        if (!form) return;
        const parent = document.getElementById('comment-parent');
        const indicator = document.getElementById('reply-indicator');
        const nameEl = document.getElementById('reply-name');
        const body = document.getElementById('comment-body');
        const count = form.querySelector('.js-count');

        function setReply(id, name) {
            parent.value = id || '';
            indicator.classList.toggle('hidden', !id);
            indicator.classList.toggle('inline-flex', !!id);
            nameEl.textContent = name || '';
        }
        document.querySelectorAll('.js-reply').forEach(function (btn) {
            btn.addEventListener('click', function () {
                setReply(btn.dataset.id, btn.dataset.name);
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
                setTimeout(function () { body.focus({ preventScroll: true }); }, 400);
            });
        });
        document.getElementById('reply-cancel').addEventListener('click', function () { setReply(null); });

        const updateCount = function () { count.textContent = body.value.length + '/2000'; };
        body.addEventListener('input', updateCount);
        updateCount();

        // After a failed submit the page reloads at the top: bring the errors into view
        if (form.querySelector('[role="alert"]')) {
            form.scrollIntoView({ block: 'start' });
        }

        // Restore the reply indicator after a failed submit
        if (parent.value) {
            const src = document.querySelector('.js-reply[data-id="' + parent.value + '"]');
            setReply(parent.value, src ? src.dataset.name : '');
        }
    })();
</script>
