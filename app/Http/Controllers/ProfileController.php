<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Profile;
use App\Facades\JAPI;

class ProfileController extends Controller
{
    /**
     * Show profile.
     * @return resource Profile in JSON API format.
     */
    public function show()
    {
        $profile = Profile::find(1);
        $payload = JAPI::marshallEntry($profile, 'profile');

        return (new Response(json_encode($payload), 200))
            ->header('Content-Type', 'application/vnd.api+json');
    }
}
