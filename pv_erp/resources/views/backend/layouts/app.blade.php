<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Way</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div>
        @section('navbar')
            <div class="page-container">
                <a class="navbar-brand" href="/">Easy Way</a>
            </div>
            <div class="d-flex">
                <a href="/" class="nav-link">Hnin Thazin Nwe</a>
                <a href="/" class="nav-link">Dashboard</a>
                <a href="/" class="nav-link">Setting</a>
                <a href="/" class="nav-link">Logout</a>
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </div>
        @endsection
        @section('layout')
        @endsection
    </div>
</body>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
</html>