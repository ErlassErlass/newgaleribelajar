<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\Contact;
use App\Support\CommentModeration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArticleCommentController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $article = Article::published()->where('slug', $slug)->firstOrFail();

        $data = $request->validateWithBag('comment', [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email:rfc|max:255',
            'body' => [
                'required', 'string', 'min:3', 'max:2000',
                // Basic link-spam guard
                function ($attr, $value, $fail) {
                    if (preg_match_all('#https?://#i', $value) > 2) {
                        $fail('Komentar berisi terlalu banyak tautan.');
                    }
                },
            ],
            'parent_id' => [
                'nullable', 'integer',
                Rule::exists('article_comments', 'id')
                    ->where('article_id', $article->id)
                    ->whereNull('parent_id'), // replies stay one level deep
            ],
            'website' => 'max:0', // honeypot
            'marketing_consent' => 'nullable|boolean',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi (tidak ditampilkan).',
            'email.email' => 'Format email tidak valid.',
            'body.required' => 'Komentar tidak boleh kosong.',
            'body.max' => 'Komentar maksimal 2000 karakter.',
            'parent_id.exists' => 'Komentar yang ingin dibalas tidak ditemukan.',
            'website.max' => 'Permintaan tidak valid.',
        ]);

        $name = strip_tags($data['name']);
        $body = strip_tags($data['body']);

        // Inappropriate words, links or all-caps: hold for an admin regardless of auto-approve
        $flag = CommentModeration::check($name, $body);
        $approved = ! $flag && (bool) config('erlass.comments_auto_approve', true);
        $consent = $request->boolean('marketing_consent');

        $comment = ArticleComment::create([
            'article_id' => $article->id,
            'parent_id' => $data['parent_id'] ?? null,
            'name' => $name,
            'email' => $data['email'],
            'body' => $body,
            'is_approved' => $approved,
            'is_flagged' => (bool) $flag,
            'flag_reason' => $flag,
            'marketing_consent' => $consent,
            'ip_address' => $request->ip(),
        ]);

        // Promotion team's contact list (email kept private; used only when consent is given)
        Contact::record($data['email'], 'komentar', ['name' => $name, 'consent' => $consent]);

        $anchor = $approved ? '#comment-'.$comment->id : '#comments';

        return redirect()->to(route('articles.show', $article->slug).$anchor)
            ->with('comment_success', $approved
                ? 'Komentar Anda berhasil dikirim. Terima kasih!'
                : 'Komentar Anda terkirim dan akan tampil setelah dimoderasi.');
    }
}
