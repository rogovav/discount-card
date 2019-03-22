<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Дисконтный карты</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav class="navbar navbar-dark nav-background navbar-expand-lg  mb-3">
    <a class="navbar-brand" href="{{ route('customers') }}">
        <img src="{{ asset('img/logo.png') }}" height="50" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ 'customers' == Route::currentRouteName() ? 'active' : null }}">
                <a class="nav-link" href="{{ route('customers') }}">В базе 1С</a>
            </li>
            <li class="nav-item {{ 'newCustomers' == Route::currentRouteName() ? 'active' : null }}">
                <a class="nav-link" href="{{ route('newCustomers') }}">Новые клиенты</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск клиента</button>
        </form>
    </div>
</nav>
<div class="container-fluid">

    <div class="row">
        <div class="col">
            <div class="table-responsive">

                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Номер карты</th>
                        <th>Телефон</th>
                        <th>Сумма</th>
                        <th>Скидка</th>
                    </tr>
                    </thead>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }} {{ $customer->surname }} {{ $customer->patronymic }}</td>
                            <td>{{ $customer->card_number }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->sum }}</td>
                            <td>{{ $customer->percent }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</html>
