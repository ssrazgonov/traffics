@extends('admin.dashboard')

@section('content')
    <h1 class="pb-4">Заявка номер {{$appeal->id}}</h1>
    <div class="row">
        <div class="col-8">
            <div class="appeal card p-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item appeal-crash"><b>Тип неисправности:</b> {{$appeal->type_of_crash->title()}}</li>
                    <li class="list-group-item appeal-comment"><b>Комментарий: </b>{{$appeal->comment}}</li>
                    <li class="list-group-item appeal-responsible">
                        <b>Ответственный:</b> {{$appeal->engineer?->name}}
                    </li>
                    <li class="list-group-item appeal-status">
                        <b>Статус:</b> {{$appeal->status->title()}}
                    </li>
                    <li class="list-group-item appeal-status">
                        <b>Адрес:</b> {{$appeal->trafficLight->address}}
                    </li>
                    <li class="list-group-item appeal-map" id="appeal-map"></li>

                    <li class="list-group-item appeal-status">
                        <b>Комментарий инженера:</b> {{$appeal->engineer_comment}}
                    </li>

                    @if($appeal->engineer_files)
                    @foreach(explode(',', rtrim($appeal->engineer_files, ',')) as $file)
                        <li class="list-group-item appeal-status">
                            <b>Файл отчета:</b> <a target="_blank" href="{{$file}}">{{$file}}</a>
                        </li>
                    @endforeach
                    @endif

                    @if($isOperator)
                        <li class="list-group-item appeal-status">
                            <a href="{{route('appeals.edit', $appeal->id)}}">Редактировать</a>
                        </li>
                    @endif

                    @if($isEngineer && $appeal->status !== \App\Enums\AppealStatus::Awaiting)
                        <form action="{{route('appeals.sendToOperator', $appeal->id)}}" method="post" enctype="multipart/form-data">
                            <div class="mt-3 mb-3">
                                <textarea name="comment" class="form-control" placeholder="Ваш комментарий о результате работы"></textarea>

                                <label class="mt-3 mb-1" for="upload-photo">Загрузите фото для отчета...</label>
                                <input id='upload-photo' type="file" name="images[]" multiple class="form-control">
                            </div>
                            <li class="list-group-item appeal-status">
                                <button class="btn btn-primary">Отправить на проверку</button>
                            </li>
                        </form>
                    @endif

                    @if($isOperator && $appeal->status == \App\Enums\AppealStatus::Awaiting)
                        <form action="{{route('appeals.sendToEngineer', $appeal->id)}}" method="post">
                            <div class="mt-3 mb-3">
                                <textarea name="comment" class="form-control" placeholder="Ваш комментарий инженеру"></textarea>
                            </div>
                            <li class="list-group-item appeal-status">
                                <button class="btn btn-primary">Отправить на доработку</button>
                            </li>
                        </form>

                        <form action="{{route('appeals.close', $appeal->id)}}" method="post">
                            <div class="mt-3 mb-3">
                                <textarea name="comment" class="form-control" placeholder="Ваш комментарий заявителю"></textarea>
                            </div>
                            <li class="list-group-item appeal-status">
                                <button class="btn btn-primary">Закрыть заявку</button>
                            </li>
                        </form>
                    @endif

                </ul>
            </div>
        </div>
        <div class="col-4">
            <div class="appeal-log">
                <ul>
                    @foreach($logs as $log)
                    <li>{{$log->created_at}} {{$log->log_text}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script>
        ymaps.ready(function() {

            let myMap = new ymaps.Map("appeal-map", {
                center: [{{$appeal->trafficLight->latitude}}, {{$appeal->trafficLight->longitude}}],
                zoom: 12
            });

            var myPlacemark = new ymaps.Placemark([{{$appeal->trafficLight->latitude}}, {{$appeal->trafficLight->longitude}}]);

            myMap.geoObjects.add(myPlacemark);
        })
    </script>
@endsection
