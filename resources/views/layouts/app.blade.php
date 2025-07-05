<!-- filepath: c:\pc5.1\biblioteca_virtual\resources\views\layouts\app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Biblioteca Virtual')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .container { max-width: 900px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 0 10px #ccc; padding: 30px; }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>