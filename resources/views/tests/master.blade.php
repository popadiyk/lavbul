<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Test')</title>
    <meta name="description" content="Laravel Shopping Cart Example">

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Store CSRF token for AJAX calls -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

@yield('extra-css')

    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

    <style>
        .spacer {
            margin-bottom: 100px;
        }
        .cart-image {
            width: 100px;
        }
        footer {
            background-color: #f5f5f5;
            padding: 20px 0;
        }
        .table>tbody>tr>td {
            vertical-align: middle;
        }
        .side-by-side {
            display: inline-block;
        }
    </style>
</head>
<body>

<header>

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ url('/cart') }}">Cart ({{ Cart::instance('default')->count(false) }})</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>

@yield('content')

<footer>

</footer>

<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

@yield('extra-js')

</body>
</html>