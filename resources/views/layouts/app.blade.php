<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <title>@yield('title', 'OverRev CarGarage')</title>
    <link rel="icon" href="https://png.pngtree.com/png-vector/20250117/ourmid/pngtree-gtr-drifting-car-jdm-modification-illustration-cars-simple-backgrounds-japanese-vector-png-image_15230219.png" type="image/png">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    @include('partials.navbar')

    <main class="pt-14">
        @yield('content')
    </main>

    @include('partials.footer')

    @vite('resources/js/app.js')
</body>

</html>