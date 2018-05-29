<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Work;
use App\Facades\JAPI;

class WorkController extends Controller
{
    /**
     * List all works.
     * @return resource List of works in JSON API format.
     */
    public function index()
    {
        $dataset = Work::all()->sortByDesc('end_date');
        $payload = JAPI::marshallDataset($dataset, 'work');

        return (new Response(json_encode($payload), 200))
            ->header('Content-Type', 'application/vnd.api+json');
    }

    /**
     * Show one work.
     * @param  resource Work $work
     * @return resource Single work in JSON API format.
     */
    public function show(Work $work)
    {
        $payload = JAPI::marshallEntry($work, 'work');

        return (new Response(json_encode($payload), 200))
            ->header('Content-Type', 'application/vnd.api+json');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        //
    }
}
