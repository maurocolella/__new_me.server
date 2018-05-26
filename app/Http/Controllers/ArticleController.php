<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Article;
use App\Facades\JAPI;

class ArticleController extends Controller
{
    /**
     * List all articles.
     * @return resource List of articles in JSON API format.
     */
    public function index()
    {
        $dataset = Article::all()->sortBy('slug');
        $payload = JAPI::marshallDataset($dataset, 'article');

        return (new Response(json_encode($payload), 200))
            ->header('Content-Type', 'application/vnd.api+json');
    }

    /**
     * Show one article.
     * @param  resource Article $article
     * @return resource Single article in JSON API format.
     */
    public function show(Article $article)
    {
        $payload = JAPI::marshallEntry($article, 'article');

        return (new Response(json_encode($payload), 200))
            ->header('Content-Type', 'application/vnd.api+json');
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all());

        return response()->json($article, 201);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function delete(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }
}
