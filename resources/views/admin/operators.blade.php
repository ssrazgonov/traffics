@extends('admin.dashboard')

@section('content')

    <h1 class="pb-4">Список операторов в системе</h1>
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
            @foreach($operators as $operator)
                <tr>
                    <td>{{$operator->id}}</td>
                    <td>{{$operator->created_at}}</td>
                    <td>{{$operator->name}}</td>
                    <td>{{$operator->email}}</td>
                    <td>
                        <a href="{{route('operators.edit', $operator->id)}}">Редактировать</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection