<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Request</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <!-- Logo -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/request-style.css') }}">
</head>

<body>
    <!-- Navigation Bar -->
    @hasSection('nav-bar')
        @yield('nav-bar')
    @else
        {{-- Default NavBar Items
             anonymous component: views -> components -> header blade --}}
        <x-header>
            <li class="nav-item">
                <a class="nav-link ms-4" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-4" href="{{  route('new-resident.requests.create') }}">Request Document</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-4" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ms-4" href="#">Inquiries</a>
            </li>
        </x-header>
    @endif

    <div class="container">
        @hasSection('content')
            @yield('content')
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer>
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script defer>
        window.addEventListener('click', function(event) {
            var $target = $(event.target);
            if (!$target.closest('.select-list').length && $(".current-select-options")[0]) {
                $(".select-options").css("display", "none");
                $(".select-options").toggleClass('current-select-options');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
