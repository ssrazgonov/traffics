@extends('admin.dashboard')

@section('content')

    <h1 class="pb-4">Список инженеров в системе</h1>
    <div class="appeals-table">
        <table class="text-center table-light table">
            <tr>
                <th>
                    id
                </th>
                <th>
                    время создания
                </th>
                <th>
                    Имя
                </th>

                <th>
                    Email
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($engineers as $engineer)
                <tr>
                    <td>{{$engineer->id}}</td>
                    <td>{{$engineer->created_at}}</td>
                    <td>{{$engineer->name}}</td>
                    <td>{{$engineer->email}}</td>
                    <td>
                        <a href="{{route('engineers.edit', $engineer->id)}}">Редактировать</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
