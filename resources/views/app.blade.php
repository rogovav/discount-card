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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
            <li class="nav-item {{ Route::currentRouteName() == 'customers' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('customers') }}">Клиенты</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'shops' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('shops') }}">Магазины</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'conditions' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('conditions') }}">Условия</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('getXML') }}">Скачать</a>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-link nav-link btn-nav-link" data-toggle="modal"
                        data-target="#uploadModal">Загрузить
                </button>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" id="search" type="search" placeholder="Поиск" aria-label="Search">
            {{--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск клиента</button>--}}
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        @section('content')
        @show
    </div>
</div>

@if ( session('status') === 1 )
    <div id="snackbar" class="snackbar-success"><i class="far fa-check-circle"></i> Данные успешно обновлены!</div>
@elseif ( session('status') === 0 )
    <div id="snackbar" class="snackbar-danger"><i class="far fa-times-circle"></i> Что-то пошло не так!</div>
@endif


<div class="modal fade" id="uploadModal" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Загрузка XML</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('updateCustomers') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="custom-file">
                        {{ csrf_field() }}
                        <input type="file" class="custom-file-input" id="customFileLangHTML" name="xml">
                        <label class="custom-file-label" for="customFileLangHTML" data-browse="Обзор">Выберите
                            файл</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Загрузить</button>
                </div>
            </form>
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
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
        let snackbar = $("#snackbar");
        snackbar ? myToast(snackbar) : null;
    });

    function myToast(element) {
        element.addClass("show");
        setTimeout(function () {
            element.removeClass("show");
        }, 3000);

    }

    $('#search').keyup(function (e) {
        let input = $(this).val();
        if (input === '') {
            $('.search-tr').show()
        } else {
            $('.search-tr').each(function (index) {
                if ($(this).text().toLowerCase().search(input.toLowerCase()) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            })
        }
    })
</script>

</html>
