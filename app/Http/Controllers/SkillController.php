<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Skill;

class SkillController extends Controller
{
	public function index()
	{
		return Skill::orderBy('rating', 'desc')->get();
	}

	public function show(Skill $skill)
	{
		return $skill;
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
