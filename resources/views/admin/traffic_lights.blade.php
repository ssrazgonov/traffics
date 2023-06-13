@extends('admin.dashboard')

@section('content')

    <h1 class="pb-4">Необработанные заявки</h1>
    <div class="appeals-table">
        <table class="text-center table-light table">
            <tr>
                <th>
                    id
                </th>
                <th>
                    время
                </th>
                <th>
                    светофор
                </th>
                <th>статус</th>
                <th>
                    действия
                </th>
            </tr>
            <tr>
                <td>2</td>
                <td>10.02.2023</td>
                <td>ул. Хренникова</td>
                <td>необработанно</td>
                <td><a href="">перейти</a></td>
            </tr>
        </table>
    </div>

@endsection
