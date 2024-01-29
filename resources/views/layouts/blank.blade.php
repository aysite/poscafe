<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | INFORKOM CAFE</title>

    @include('layouts.sc_header')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        {{-- Main Content --}}
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        {{-- End Content --}}
    </div>

    {{-- Required Script --}}
    @include('layouts.sc_footer')
    @yield('custom_js')    
</body>

</html>