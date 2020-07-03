<?php

namespace App\Http\Controllers;
use App\Article;
use App\Comment;
use App\User;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store( CommentRequest $request, Comment $comment, Article $article)
    {
        //dd($request);
           $comment->fill($request->all());
           $comment->user_id = $request->user()->id;
           $comment->article_id = $request->article_id;
           $comment->save();

         return redirect()->route('articles.show', [
            'article' => $article,
        ]);

    }
}
