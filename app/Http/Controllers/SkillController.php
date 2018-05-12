<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Skill;
use App\Facades\JAPI;

class SkillController extends Controller
{
    /**
     * List all skills.
     * @return resource List of skills in JSON API format.
     */
    public function index()
    {
        $dataset = Skill::orderBy('title', 'asc')->get();
        $payload = JAPI::marshallDataset($dataset, 'skill');

        return (new Response(json_encode($payload), 200))
            ->header('Content-Type', 'application/vnd.api+json');
    }

    /**
     * Show one skill.
     * @param  resource Skill $skill
     * @return resource Single skill in JSON API format.
     */
    public function show(Skill $skill)
    {
        $payload = JAPI::marshallEntry($skill, 'skill');

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
