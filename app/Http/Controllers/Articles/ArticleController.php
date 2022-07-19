<?php

namespace App\Http\Controllers\Articles;

use App\Models\Article;
use App\Models\ArticleTags;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('category','user')->latest()->paginate(10);
        return view('articles.index',compact('articles'));
  
    }

    public function myArticles()
    {
        $articles = Article::with('category','user')->where('user_id',auth()->user()->id)->paginate(10);
        return view('articles.my-articles',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ArticleCategory::select('id','name')->get();
        $tags = ArticleTags::select('id','name')->get();
        return view('articles.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage. testing something
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $article = Article::create([
            'title' => $request->title,
            'full_text' => $request->full_text,
            'category_id' => $request->category,
            'tags' => implode(',',$request->tag),
            'user_id' => auth()->id(),
            'image_upload' => 'default.png',
        ]);

        if($request->hasFile('image'))
        {
            $imageName = request()->file('image')->getClientOriginalName();
            request()->file('image')->storeAs('public/articleImages',$article->id.'/'.$imageName);
            $article->update(['image_upload' => $imageName]);
        }

        return redirect()->route('articles.index')->with('message', 'Article successfully created!');
     
    }


    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $category = ArticleCategory::find($article->category_id);
        $tagss = ArticleTags::select('id','name')->get();
        return view('articles.show',compact('article','category','tagss'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        
       if( auth()->id() != $article->user_id ){
          return view('errors.403');
       }

        $categories = ArticleCategory::select('id','name')->get();
        $tagss = ArticleTags::select('id','name')->get();
        return view('articles.edit',compact('article','categories','tagss'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::where('id',$id)->update([
            'title' => $request->title,
            'full_text' => $request->full_text,
            'category_id' => $request->category,
            'tags' => implode(',',$request->tag),
            'user_id' => auth()->id()
        ]);

        if($request->hasFile('image'))
        {
           //if there's a record, delete what's currently in record
            if( Storage::exists('public/articleImages/'.$id) ){
                Storage::deleteDirectory('public/articleImages/'.$id);
            }

            $imageName = request()->file('image')->getClientOriginalName();
            request()->file('image')->storeAs('public/articleImages',$id.'/'.$imageName);
            Article::find($id)->update(['image_upload' => $imageName]);
          
        }

        return redirect()->route('articles.index')->with('message', 'Article successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
    }
}
