@extends('admin.dashboard')

@section('content')
    <h1 class="pb-4">Заявка номер 2</h1>
    <div class="appeal card p-3">
        <ul class="list-group list-group-flush">
            <li class="list-group-item appeal-crash"><b>Тип неисправности:</b> Сфетофор не горит</li>
            <li class="list-group-item appeal-comment"><b>Комментарий: </b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab assumenda cum deleniti dignissimos dolorem dolores ducimus ea et fugit inventore ipsum laborum magnam, minima nesciunt officia, qui ratione temporibus velit.</li>
            <li class="list-group-item appeal-responsible">
                <b>Ответственный:</b> Иванов И.И
            </li>
            <li class="list-group-item appeal-status">
                <b>Статус:</b> В работе
            </li>
            <li class="list-group-item appeal-map" id="appeal-map"></li>
            <li class="list-group-item appeal-status">
                <a href="">Редактировать</a>
            </li>
        </ul>
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
