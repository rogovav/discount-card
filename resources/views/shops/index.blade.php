@extends('app')

@section('content')
    <div class="col">
        <div class="table-responsive">

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Адрес</th>
                    <th>Координаты</th>
                    <th>Телефон</th>
                    <th>Время работы</th>
                    <th>Информация</th>
                </tr>
                </thead>
                @foreach($shops as $shop)
                    <tr class="search-tr">
                        <td>{{ $shop->address }}</td>
                        <td>{{ $shop->coordinates }}</td>
                        <td>{{ $shop->phone }}</td>
                        <td>{{ $shop->working }}</td>
                        <td>{{ $shop->info }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
