<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Article;

class ArticleController extends Controller
{
	/**
	 * List all articles.
	 * @return [[Type]] [[Description]]
	 */
	public function index()
	{
		$payload = new \stdClass;
		$articles = Article::all();
		$payload->data = array();

		$articles->each(function ($item, $key) use ($payload) {
			$entry = new \stdClass;
			$entry->type = 'article';
			$entry->id = $item->id;
			$entry->attributes = new \stdClass;

			foreach($item->toArray() as $propName => $propVal){
				if(strcmp('id', $propName) !== 0){
					$entry->attributes->$propName = $propVal;
				}
			}

			$payload->data[] = $entry;
		});

		return (new Response(json_encode($payload), 200))
			->header('Content-Type', 'application/vnd.api+json');
	}

	public function show(Article $article)
	{
		$payload = new \stdClass;
		$payload->data = new \stdClass;
		$payload->data->type = 'article';
		$payload->data->id = $article->id;
		$payload->data->attributes = new \stdClass;

		foreach($article->toArray() as $propName => $propVal){
			if(strcmp('id', $propName) !== 0){
				$payload->data->attributes->$propName = $propVal;
			}
		}

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
