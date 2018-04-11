<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Skill;

class SkillController extends Controller
{
	public function index()
	{
		$payload = new \stdClass;
		$skills = Skill::orderBy('title', 'asc')->get();
		$payload->data = array();

		$skills->each(function ($item, $key) use ($payload) {
			$entry = new \stdClass;
			$entry->type = 'skill';
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

	public function show(Skill $skill)
	{
		$payload = new \stdClass;
		$payload->data = new \stdClass;
		$payload->data->type = 'skill';
		$payload->data->id = $skill->id;
		$payload->data->attributes = new \stdClass;

		foreach($skill->toArray() as $propName => $propVal){
			if(strcmp('id', $propName) !== 0){
				$payload->data->attributes->$propName = $propVal;
			}
		}

		return (new Response(json_encode($payload), 200))
			->header('Content-Type', 'application/vnd.api+json');
	}

	public function store(Request $request)
	{
		$skill = Skill::create($request->all());

		return response()->json($skill, 201);
	}

	public function update(Request $request, Skill $skill)
	{
		$skill->update($request->all());

		return response()->json($skill, 200);
	}

	public function delete(Skill $skill)
	{
		$skill->delete();

		return response()->json(null, 204);
	}
}
