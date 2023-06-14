@extends('admin.dashboard')

@section('content')
    <h1 class="pb-4">Заявки ожидающие проверки</h1>
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
                <th>
                    статус
                </th>
                <th>
                    инженер
                </th>
                <th></th>
            </tr>

            @if(!$appeals)
                <tr>
                    <td>
                        Нет заявок
                    </td>
                </tr>
            @endif
            @foreach($appeals as $appeal)
                <tr>
                    <td>{{$appeal->id}}</td>
                    <td>{{$appeal->created_at}}</td>
                    <td>{{$appeal->trafficLight->address}}</td>
                    <td>{{$appeal->status->title()}}</td>
                    <td>{{$appeal->engineer->name}}</td>
                    <td>
                        <a href="{{route('appeals.view', $appeal->id)}}">перейти</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
