@extends('admin.dashboard')

@section('content')

    <style>
        .progress-bar {
            text-align: right;
            color: black;
            font-size: 17px;
            padding-right: 30px;
        }
        .progress {
            max-width: 600px;
        }
    </style>

    <h3 class="mt-5">Заявки</h3>
    <p class="mt-2">Не обработанные заявки: {{$appealsNotProcessed}} из {{$appeals}}</p>
    <div class="progress mb-3">

        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: {{$appealsNotProcessedProc}}%" aria-valuenow="{{$appealsNotProcessedProc}}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <p class="mt-2">Заявки в работе: {{$appealsInWork}} из {{$appeals}}</p>
    <div class="progress mb-3">
        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {{$appealsInWorkProc}}%" aria-valuenow="{{$appealsInWorkProc}}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <p class="mt-2">Выполненные заявки: {{$appealsComplete}} из {{$appeals}}</p>
    <div class="progress mb-3">
        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$appealsCompleteProc}}%" aria-valuenow="{{$appealsCompleteProc}}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <h3 class="mt-5">Светофоры</h3>

    <p class="mt-2">В рабочем состоянии: {{$tfW}} из {{$tf}}</p>
    <div class="progress mb-3">

        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$tfWProc}}%" aria-valuenow="{{$tfWProc}}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <p class="mt-2">В ремонте: {{$tfNW}} из {{$tf}}</p>
    <div class="progress mb-3">
        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: {{$tfNWProc}}%" aria-valuenow="{{$tfNWProc}}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
@endsection
