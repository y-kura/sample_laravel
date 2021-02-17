<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = request('user_id');
        $category_id = request('category_id');

        //$articles = Article::all();
        $query = Article::where(function($query) {
            $query->where('public_flag', true);
            if (Auth::check()) {
                $query->orWhere('user_id', Auth::id());
            }
        });
        if ($user_id) {
            $query->where('user_id', $user_id);
        }
        if ($category_id) {
            $query->where('category_id', $category_id);
        }
        $articles = $query->orderBy('id', 'desc')->paginate(10);
        //$articles = Article::paginate(3);
        $category_names = Category::getNames();
        return view('article.index', compact('articles', 'category_names'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_names = Category::getNames();
        return view('article.create', compact('category_names'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = $request->all();
        $article['user_id'] = Auth::id();
        $article['public_flag'] = (isset($article['public_flag']) && $article['public_flag']);
        Article::create($article);
        return redirect()->route('article.index')->with('success', '記事を投稿しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if (!$article) {
            abort(404);
        }

        $category_names = Category::getNames();
        return view('article.show', compact('article', 'category_names'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        if (!$article) {
            abort(404);
        }
        if ($article->user_id != Auth::id()) {
            abort(403);
        }

        $category_names = Category::getNames();
        return view('article.edit', compact('article', 'category_names'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::find($id);
        if (!$article) {
            abort(404);
        }
        if ($article->user_id != Auth::id()) {
            abort(403);
        }

        $update = [
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'posted_at' => $request->posted_at,
            'public_flag' => $request->public_flag,
        ];
        Article::where('id', $id)->update($update);
        return redirect()->route('article.show', $id)->with('success', '記事を修正しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if (!$article) {
            abort(404);
        }
        if ($article->user_id != Auth::id()) {
            abort(403);
        }

        Article::where('id', $id)->delete();
        return redirect()->route('article.index')->with('success', "記事「{$article->title}」を削除しました。");
    }
}
