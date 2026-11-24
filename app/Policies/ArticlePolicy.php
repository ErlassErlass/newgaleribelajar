<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

/**
 * Content Writer: create articles, edit/delete own drafts, submit them for review.
 * Admin / Super Admin: everything, including approve, reject, publish and pin.
 */
class ArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return true; // every panel role works with articles
    }

    public function view(User $user, Article $article): bool
    {
        return $user->isAdmin() || $article->author_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Article $article): bool
    {
        return $user->isAdmin()
            || ($article->author_id === $user->id && in_array($article->status, [Article::STATUS_DRAFT, Article::STATUS_REJECTED], true));
    }

    public function delete(User $user, Article $article): bool
    {
        return $user->isAdmin()
            || ($article->author_id === $user->id && $article->status === Article::STATUS_DRAFT);
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /** Approve / reject / publish / unpublish / pin. */
    public function publish(User $user, ?Article $article = null): bool
    {
        return $user->isAdmin();
    }

    public function submitForReview(User $user, Article $article): bool
    {
        return $article->author_id === $user->id
            && in_array($article->status, [Article::STATUS_DRAFT, Article::STATUS_REJECTED], true);
    }
}
