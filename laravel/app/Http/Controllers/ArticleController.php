<?php

namespace App\Http\Controllers;
use App\Article;
use App\Tag;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    public function index()
    {

        $articles = Article::all()->sortByDesc('created_at')
        ->load('user', 'likes', 'tags');

    /** 第一引数にはビューファイル名 (articlesディレクトリにある、indexという名前のビューファイル)*/
    /** 第二引数にはビューファイルに渡す変数の名称と、その変数の値を連想配列形式で指定 */
    /** 'articles'というキーを定義することで、ビューファイル側で$articlesという変数が使用できるようになる。*/
    /* ビューファイル側で使う$articles変数の中身の値は、このindexアクションメソッドで定義したダミーデータ$articlesの値となります。 */

    return view('articles.index', ['articles' => $articles,
    ]);
}
    public function create()
    {
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });
 
        return view('articles.create', [
            'allTagNames' => $allTagNames,
        ]);
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all()); //-- この行を追加
        $article->user_id = $request->user()->id;
        $article->save();

        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        $tagNames = $article->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });
        return view('articles.edit', [
            'article' => $article,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all())->save();

        $article->tags()->detach();
        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        return redirect()->route('articles.index');
    }
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
    $comments = $article->comments->sortByDesc('created_at');

    // foreach( $comments as $com) {
    //     // $com_data[] = $com->user()->pluck('name')->all();
    //     $com_data[] = $com->user()->get();
    // }
    // $com_data = collect($com_data);
    // $com_data = $com_data->flatten(1);

    // $com_user = [];
    // foreach( $com_data as $data) {
    //     // $com_data[] = $com->user()->pluck('name')->all();
    //     $com_user[] = $data->only(['name','my_pic']);
    // }

    // $conbined = [];
    // $size = count($comments);

    // for($i = 0; $i < $size ; $i++) {
    //     $arrayed_comments = $comments[$i]->toArray();

    //     $name = $com_user[$i]['name'];
    //     $pic = $com_user[$i]['my_pic'];
    //     array_push($arrayed_comments, $name);
    //     array_push($arrayed_comments, $pic);

    //     $conbined[$i] = $arrayed_comments;
    // }

    // $conbined = collect($conbined);
    // $conbined = $conbined->sortByDesc('created_at');

    return view('articles.show', [
    'article' => $article,
   // 'com_data' => $conbined,
    'comments' => $comments,
    ]);
    }

     public function like(Request $request, Article $article)
     {
         $article->likes()->detach($request->user()->id);
         $article->likes()->attach($request->user()->id);
 
         return [
             'id' => $article->id,
             'countLikes' => $article->count_likes,
         ];
     }
 
     public function unlike(Request $request, Article $article)
     {
         $article->likes()->detach($request->user()->id);
 
         return [
             'id' => $article->id,
             'countLikes' => $article->count_likes,
         ];
     }
     //==========ここまで追加==========
}
