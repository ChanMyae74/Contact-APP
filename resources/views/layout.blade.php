<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="min-vh-100 bg" style="overflow-x: hidden">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 mt-3">

                <div>
                    {{-- <h1 class="text-center">Contact App</h1> --}}
                    @yield('bread')
                </div>
                <div>
                    @yield("content")
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>

</html>
