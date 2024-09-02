<?php

namespace App\Services;

use App\Models\Article;
use App\Notifications\ArticleCreatedNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\StoreArticleRequest;

class ArticleService
{
    public static function store(StoreArticleRequest $request): Model|Builder
    {
        $article = Article::query()
            ->create($request->validated());
        $user = $article->user;

        $user->notify(new ArticleCreatedNotification($article));
//        Notification::send($user, new ArticleCreatedNotification($article));
        // do something!
        // ...

        return $article;
    }
}
