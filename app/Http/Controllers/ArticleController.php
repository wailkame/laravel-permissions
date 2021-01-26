<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $articles  = Article::with('user')->get();
        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('article.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Article::create($request->all() + [
        'user_id'=> Auth::id(),
        'published_at' => Auth::user()->role_id == 2 || Auth::user()->role_id == 3 && $request->input('published') ? now() :null
        ]);
        return redirect()->route('article.index');
        
        // Validator::make($request->all(), [
        //     'title' => 'required',
        //     'description' => 'required',
        //     'user_id' => 'required'
        // ])->validate();

        // $article = new Article;
        // $article->title = $request->title;
        // $article->full_text = $request->description;
        // $article->category_id = $request->category_id;
        // $article->save();
        // return redirect('article.index')->with('status', 'Article Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
        $categories = Category::all();
        return view('article.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
        $data = $request->all();
        if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3){
            $data['published_at'] = $request->input('published') ? now(): null;
        }
        $article->update($data);
        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
