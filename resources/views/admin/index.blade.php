@extends('admin.dashboard')

@section('content')
    <h1>Панель управления</h1>

    <h3 class="mt-3">Отчет по заявкам</h3>

    <p class="mt-2">Не обработанные заявки</p>
    <div class="progress mb-3">

        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <p class="mt-2">Заявки в работе</p>
    <div class="progress mb-3">
        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <p class="mt-2">Выполненные заявки</p>
    <div class="progress mb-3">
        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <h3 class="mt-5">Отчет по светофорам</h3>

    <p class="mt-2">В рабочем состоянии</p>
    <div class="progress mb-3">

        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <p class="mt-2">В ремонте</p>
    <div class="progress mb-3">
        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
@endsection
