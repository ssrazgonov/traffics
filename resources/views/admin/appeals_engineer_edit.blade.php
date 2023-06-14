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
                    <li class="list-group-item appeal-map" id="appeal-map"></li>
                    <li class="list-group-item appeal-status">
                        <a href="{{route('appeals.edit', $appeal->id)}}">Редактировать</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-4">
            <div class="appeal-log">
                <ul>
                    <li>12.06.2023 12:00 Оператор изменил статус заявки с Не обработно на в Работе</li>
                    <li>12.06.2023 12:10  Оператор назначил инженера: Артем Семирамидов</li>
                    <li>12.06.2023 12:15 Оператор изменил инженера с Артем Семирамидов на Хенк Муди</li>
                    <li>12.06.2023 22:34 Инженер отправил заявку на проверку</li>
                    <li>12.06.2023 22:34 Оператор изменил статус заявки с в Работе на Завершено</li>
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script>
        ymaps.ready(function() {

            let myMap = new ymaps.Map("appeal-map", {
                center: [52.599504, 39.632270],
                zoom: 12
            });

            var myPlacemark = new ymaps.Placemark([52.599504, 39.632270]);

            myMap.geoObjects.add(myPlacemark);
        })
    </script>
@endsection
