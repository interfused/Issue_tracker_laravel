@extends('layouts.master', ['body_class' => 'body__welcome'])

@section('title', 'Issue Tracker : Proof of Concept Welcome')

@section('content')

    @if (Session::has('logged_in_user'))
        <div>
            <p><strong>Hi, {{ Session::get('logged_in_user')->name_first }}, welcome back!</strong></p>
        </div>
    @endif
    <p>This proof of concept has been designed for bare bones functionality. Some best practices and/or decent
        UI/UX and front-end design have not been taken into consideration. <strong>Yes this is UGLY and generic!</strong> We
        are focused on functionality at the moment. Basic Bootstrap has been utilized for prototyping. The purpose of this
        project is to
        explore Laravel and the MVC architecture framework.</p>

    <?php //print_r($session_data)
    ?>

@endsection
