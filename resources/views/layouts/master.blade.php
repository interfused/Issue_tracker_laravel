<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @include('layouts.head')

    @hasSection('headerScriptsAndStyles')
        @yield('headerScriptsAndStyles')
    @endif

</head>

<body class="{{ !empty($body_class) ? $body_class : '' }}">


    @include('layouts.header')

    <main>

        <div class="row">
            @hasSection('sidebar')
                <div class="col-md-3">
                    @section('sidebar')
                        <h2>Sidebar Master Header</h2>
                    @show
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>
            @endif

            @sectionMissing('sidebar')
                @yield('content')
            @endif
        </div>
    </main>

    @include('layouts.footer')
</body>

</html>
