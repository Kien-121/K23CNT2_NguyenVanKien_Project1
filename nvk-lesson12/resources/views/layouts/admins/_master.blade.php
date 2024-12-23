<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="ttps://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <title>@yield('title')</title>

    <style>
       {
        body
        {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
        }
        .sideBar {
            width: 250px;
            min-height: 100vh;
            background: #343a40;
            color: white;
            position: fixed;
        }
        .sideBar {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
            transition: background 0.3s;
        }
        .sideBar a:hover {
            background: #495057;
        }
        .wrapper {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            background: #ffffff;
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        header {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .content-body {
            margin-top: 20px;
            padding: 20px;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    }
    </style>
</head>
<body style="background: #ccc">
    <section class="container-fluid d-flex">
        <nav class="sideBar m-1">
            @include('layouts.admins._menu')
        </nav>
        <section class="wrapper m-1">
            <header class="border my-1">
                @include('layouts.admins._headerTitle')
            </header>
            <section class="content-body my-1">
                @yield('content-body')
            </section>
        </section>
    </section>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>