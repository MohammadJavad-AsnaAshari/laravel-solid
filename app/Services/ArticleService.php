<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\StoreArticleRequest;

class ArticleService
{
    public static function store(StoreArticleRequest $request): Model|Builder
    {
        $article = Article::query()
            ->create($request->validated());

        // sending email notifications
        // do something!
        // ...

        return $article;
    }
}
