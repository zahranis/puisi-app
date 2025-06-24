<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puisi App - @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-7ABi5O+1otJf9rN+dBdl/JwPTe4w1DS5cATD0IuMZbbmavU+Vf6M1vE3n5Udw2yG" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    @include('layouts.header')

    <main class="container py-4 flex-grow-1">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-vEN1h8yI7zwpJZ7UDFVlddvIHb0uZALz0aDmtZbNygJkR61ZJmZgSyQJihd4XLve" crossorigin="anonymous">
    </script>
</body>

</html>
