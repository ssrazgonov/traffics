@extends('admin.dashboard')

@section('content')

    <h1 class="pb-4">Список светофоров</h1>
    <div class="appeals-table">
        <table class="text-center table-light table">
            <tr>
                <th>
                    id
                </th>
                <th>
                    адрес
                </th>
                <th>
                    qr код
                </th>
                <th>статус</th>
            </tr>
            @foreach($traffics as $traffic)
                <tr>
                    <td>{{$traffic->id}}</td>
                    <td>{{$traffic->address}}</td>
                    <td><a target="_blank" href="/storage/traffic_lights/{{$traffic->qr_code}}"><img width="100px" src="/storage/traffic_lights/{{$traffic->qr_code}}" alt=""></a></td>
                    <td>{{$traffic->status}}</td>
                </tr>
            @endforeach
        </table>

        <div class="d-flex">
            {{$traffics->links()}}
        </div>
    </div>

@endsection
