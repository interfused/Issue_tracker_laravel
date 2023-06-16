<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\AppServiceProvider;
use App\Models\User;

class WelcomeController extends Controller
{
    //request is everything from form to endpoint

    //request is everything from form to endpoint
    public function getItem(Request $request)
    {
        /* \Log::info(json_encode($request->all())); */

        return view('welcome', ['session_data' => $request->session()]);
    }
}
