<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\AppServiceProvider;
use App\Models\User;

class UserController extends Controller
{
    //request is everything from form to endpoint
    public function getRegistrationForm(Request $request)
    {
        //\Log::info(json_encode($request->all()));
        return view('user.registration', ['session_data' => $request->session()]);
    }

    //request is everything from form to endpoint
    public function saveItem(Request $request)
    {
        /* \Log::info(json_encode($request->all())); */
        if (User::where('email', $request->email)->first()) {
            session(['user_registered_email' => $request->email]);
            return view('user.registration', ['session_data' => $request->session()]);
        }

        $newUser = new User;
        $fields = ['name_first', 'name_last', 'email', 'phone', 'user_groups'];
        //$newUser->name_first = $request->name_first;
        foreach ($fields as $field) {
            $newUser->$field = $request->$field;
        }
        //SUPER HORRIBLE!!! DEMO ONLY
        $newUser->password = 'demoonly';

        $newUser->save();

        return view('welcome', ['session_data' => $request->session()]);
    }

    public function login(Request $request)
    {
        /* \Log::info(json_encode($request->all())); */
        $request->session()->forget('attempt_login');

        $user = User::where('email', $request->email)->first();

        if ($user) {
            session(['user_registered_email' => $user->email]);
            return redirect('/');
        }

        $request->session()->forget('user_registered_email');
        return view('user.login', ['session_data' => $request->session()]);
    }

    public function attemptLogin(Request $request)
    {
        /* \Log::info(json_encode($request->all())); */
        session(['attempt_login' => 1]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            session(['logged_in_user' => $user]);
            return redirect('/issues');
        }

        $request->session()->forget('user_registered_email');
        return view('user.login', ['session_data' => $request->session()]);
    }


    public function logout(Request $request)
    {
        //\Log::info(json_encode($request->all()));

        $request->session()->invalidate();
        //return view('welcome', ['session_data' => $request->session()]);

        return redirect('/issues');
    }
}
