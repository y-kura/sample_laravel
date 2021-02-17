<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = $request->all();
        $comment['user_id'] = Auth::id();

        $request->validate([
            'article_id' => 'required|exists:App\Models\Article,id',
            'text' => 'required|max:100',
        ]);

        Comment::create($comment);
        return redirect()->route('article.show', $comment['article_id'])->with('success', 'コメントしました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            abort(404);
        }
        if ($comment->user_id != Auth::id()) {
            abort(403);
        }

        Comment::where('id', $id)->delete();
        return redirect()->route('article.show', $comment['article_id'])->with('success', 'コメントを削除しました。');
    }
}
