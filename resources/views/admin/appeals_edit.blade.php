@extends('admin.dashboard')

@section('content')
    <h1 class="pb-4">Заявка номер {{$appeal->id}}</h1>
    <div class="row">
        <div class="col-8">
            <div class="appeal card p-3">
                <form action="{{route('appeals.operator_save')}}" method="post">
                    <input type="hidden" value="{{$appeal->id}}" name="id">
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item appeal-comment">
                            <b>Комментарий заявителя: </b> {{$appeal->comment}}
                        </li>

                        <li class="list-group-item appeal-status">
                            <b>Статус:</b> {{$appeal->status->title()}}
                        </li>
                        <li class="list-group-item appeal-crash"><b>Тип неисправности:</b>
                            <select name="type_of_crash" class="form-control mt-3">
                                @foreach($type_of_crash as $type)
                                        <?php $selected = $appeal->type_of_crash == $type ? 'selected' : ''; ?>
                                    <option {{$selected}} value="{{$type}}">{{$type->title()}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li class="list-group-item appeal-responsible">
                            <b>Ответственный:</b>
                            <select name="responsible" class="form-control mt-3">
                                <option {{$appeal->engineer_id == null}}>Выберите инженера</option>
                                @foreach($engineers as $engineer)
                                        <?php $selected = $appeal->engineer_id == $engineer->id ? 'selected' : ''; ?>
                                    <option {{$selected}} value="{{$engineer->id}}">{{$engineer->name}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li class="list-group-item appeal-map" id="appeal-map"></li>
                        <li class="list-group-item appeal-status">
                            <button class="btn btn-primary">Сохранить</button>
                        </li>
                    </ul>
                </form>
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
                center: [52.599504, 39.632270],
                zoom: 12
            });

            var myPlacemark = new ymaps.Placemark([52.599504, 39.632270]);

            myMap.geoObjects.add(myPlacemark);
        })
    </script>
@endsection
