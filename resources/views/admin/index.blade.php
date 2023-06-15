@extends('admin.dashboard')

@section('content')

    <style>
        .progress-bar {
            text-align: right;
            color: black;
            font-size: 17px;
            padding-right: 30px;
        }
    </style>

    <h3 class="mt-5">Заявки</h3>
    <p class="mt-2">Не обработанные заявки: {{$appealsNotProcessed}} из {{$appeals}}</p>
    <div class="progress mb-3">

        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: {{$appealsNotProcessedProc}}%" aria-valuenow="{{$appealsNotProcessedProc}}" aria-valuemin="0" aria-valuemax="100">
            {{$appealsNotProcessedProc}}%
        </div>
    </div>

    <p class="mt-2">Заявки в работе: {{$appealsInWork}} из {{$appeals}}</p>
    <div class="progress mb-3">
        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {{$appealsInWorkProc}}%" aria-valuenow="{{$appealsInWorkProc}}" aria-valuemin="0" aria-valuemax="100">
            {{$appealsInWorkProc}}%
        </div>
    </div>

    <p class="mt-2">Выполненные заявки: {{$appealsComplete}} из {{$appeals}}</p>
    <div class="progress mb-3">
        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$appealsCompleteProc}}%" aria-valuenow="{{$appealsCompleteProc}}" aria-valuemin="0" aria-valuemax="100">
            {{$appealsCompleteProc}}%
        </div>
    </div>

    <h3 class="mt-5">Светофоры</h3>

    <p class="mt-2">В рабочем состоянии: {{$tfW}} из {{$tf}}</p>
    <div class="progress mb-3">

        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$tfWProc}}%" aria-valuenow="{{$tfWProc}}" aria-valuemin="0" aria-valuemax="100">
            {{$tfWProc}}%
        </div>
    </div>

    <p class="mt-2">В ремонте: {{$tfNW}} из {{$tf}}</p>
    <div class="progress mb-3">
        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: {{$tfNWProc}}%" aria-valuenow="{{$tfNWProc}}" aria-valuemin="0" aria-valuemax="100">
            {{$tfNWProc}}%
        </div>
    </div>
@endsection
