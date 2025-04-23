<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- LINKS --}}

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQIeA8LpUU3QvjaWvL4mM6mZ9YmGk2A0DgL0vI3TxK6pNMzEw2E5fdgIa" crossorigin="anonymous">


    {{-- SCRIPS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var urlBase = {!! json_encode(url('/')) !!}
    </script>

    {{-- Iconos --}}
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="icon" href="{{ asset('img/icono.png') }}" type="image/x-icon">


</head>
<body>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A1HmdNp1y5HI1ceS9+StI2l0fH2cLlDjPekKxyjH6NrEOJpjo" crossorigin="anonymous"></script>

</body>
</html>
