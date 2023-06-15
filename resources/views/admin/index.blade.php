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
    <p class="mt-2">Не обработанные заявки</p>
    <div class="progress mb-3">

        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: {{$appealsNotProcessed}}%" aria-valuenow="{{$appealsNotProcessed}}" aria-valuemin="0" aria-valuemax="100">
            {{$appealsNotProcessed}}%
        </div>
    </div>

    <p class="mt-2">Заявки в работе</p>
    <div class="progress mb-3">
        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {{$appealsInWork}}%" aria-valuenow="{{$appealsInWork}}" aria-valuemin="0" aria-valuemax="100">
            {{$appealsInWork}}%
        </div>
    </div>

    <p class="mt-2">Выполненные заявки</p>
    <div class="progress mb-3">
        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$appealsComplete}}%" aria-valuenow="{{$appealsComplete}}" aria-valuemin="0" aria-valuemax="100">
            {{$appealsComplete}}%
        </div>
    </div>

    <h3 class="mt-5">Светофоры</h3>

    <p class="mt-2">В рабочем состоянии</p>
    <div class="progress mb-3">

        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{$tfW}}%" aria-valuenow="{{$tfW}}" aria-valuemin="0" aria-valuemax="100">
            {{$tfW}}%
        </div>
    </div>

    <p class="mt-2">В ремонте</p>
    <div class="progress mb-3">
        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: {{$tfNW}}%" aria-valuenow="{{$tfNW}}" aria-valuemin="0" aria-valuemax="100">
            {{$tfNW}}%
        </div>
    </div>
@endsection
