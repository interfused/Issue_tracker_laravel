@extends('layouts.master', ['body_class' => 'body__user_registration'])
@section('title', 'Login')

@section('footerScripts')
    <script src="{{ asset('js/registerUser.js') }}"></script>
@endsection

@section('content')
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        <h2>User Registration</h2>

        <?php
        //echo '<p>Registered check: ' . print_r($session_data) . '</p>';
        ?>

        <form method="post" action="{{ route('registerUser') }}" accept-charset="UTF-8">
            {{ csrf_field() }}

            <?php
            $mappings = [];
            $mappings[] = ['label' => 'First Name', 'inputName' => 'name_first'];
            $mappings[] = ['label' => 'Last Name', 'inputName' => 'name_last'];
            $mappings[] = ['label' => 'Email', 'inputName' => 'email'];
            $mappings[] = ['label' => 'Phone', 'inputName' => 'phone'];
            
            foreach ($mappings as $el) {
                echo '<div class="form-group">';
                echo '<label for="' . $el['inputName'] . '">' . $el['label'] . '</label>';
                echo '<input type="text" name="' . $el['inputName'] . '" class="form-control" required />';
                echo '</div>';
            }
            ?>

            <div class="form-group">
                <label for="isEmployee">Is Employee?</label>
                <input type="checkbox" name="isEmployee" />
            </div>
            <input type="hidden" name="user_groups" value="0">

            <div class="employeeGroupSelection form-group hidden">
                <label>Employee Group</label>
                <select name="employeeGroup" class="form-control">
                    <option value="0">Select</option>
                    <option value="9">Admin</option>
                    <option value="1">Employee Group 1</option>
                    <option value="2">Employee Group 2</option>
                    <option value="3">Employee Group 3</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Register user</button>

        </form>

    </div>
@endsection
