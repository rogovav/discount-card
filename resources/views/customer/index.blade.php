@extends('app')

@section('content')



    <div class="col">
        <div class="table-responsive">

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Email</th>
{{--                    <th>День рождения</th>--}}
                    <th>Телефон</th>
                    <th>Номер карты</th>
                    <th>Сумма</th>
                    <th>Скидка</th>
{{--                    <th>MAC</th>--}}
{{--                    <th>В системе</th>--}}
                </tr>
                </thead>
                @foreach($customers as $customer)
                    <tr class="search-tr">
                        <td>{{ $customer->name }} {{ $customer->surname }} {{ $customer->patronymic }}</td>
{{--                        <td>{{ $customer->birthday }}</td>--}}
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ "KREPM" . $customer->card_number }}</td>
                        <td>{{ $customer->sum }}</td>
                        <td>{{ $customer->percent }}</td>
{{--                        <td>{{ $customer->MAC }}</td>--}}
{{--                        <td>{{ $customer->registered? 'Да' : 'Нет' }}</td>--}}
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
