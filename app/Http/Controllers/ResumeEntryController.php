<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\ResumeEntry;
use App\Facades\JAPI;

class ResumeEntryController extends Controller
{
    /**
     * List all articles.
     * @return [[Type]] [[Description]]
     */
    public function index()
    {
        $dataset = ResumeEntry::all();
        $payload = JAPI::marshallDataset($dataset, 'resumeentry');

        return (new Response(json_encode($payload), 200))
            ->header('Content-Type', 'application/vnd.api+json');
    }

    public function show(ResumeEntry $entry)
    {
        $tasks = $entry->tasks()->get();
        $payload = JAPI::marshallEntry($entry, 'resumeentry');

        return (new Response(json_encode($payload), 200))
            ->header('Content-Type', 'application/vnd.api+json');
    }

    public function store(Request $request)
    {
        $resumeentry = ResumeEntry::create($request->all());

        return response()->json($resumeentry, 201);
    }

    public function update(Request $request, ResumeEntry $entry)
    {
        $entry->update($request->all());

        return response()->json($entry, 200);
    }

    public function delete(ResumeEntry $entry)
    {
        $entry->delete();

        return response()->json(null, 204);
    }
}
