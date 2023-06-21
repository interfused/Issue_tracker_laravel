@extends('layouts.master', ['body_class' => 'body__user_login'])

@section('title', 'Issue Tracker Login')

@section('content')
    <h2>User Login</h2>

    <?php
    //echo '<p>Registered check: ' . print_r($session_data) . '</p>';
    ?>

    @if (Session::has('attempt_login'))
        @if (!Session::has('logged_in_user'))
            <div class="alert alert-danger">
                User not found. <a href="{{ route('getRegisterUserForm') }}">Create an account</a>
            </div>
        @endif
    @endif

    <form method="post" action="{{ route('loginUser') }}" accept-charset="UTF-8">
        {{ csrf_field() }}



        <?php
        $mappings = [];
        $mappings[] = ['label' => 'Email', 'inputName' => 'email'];
        ?>
        @foreach ($mappings as $el)
            <div class="form-group">
                <label for="{{ $el['inputName'] }}">{{ $el['label'] }}</label>
                <input type="text" name="{{ $el['inputName'] }}" class="form-control" />
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Login</button>

    </form>
@endsection
