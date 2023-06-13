@extends('admin.dashboard')

@section('content')

    <h1 class="pb-4">Заявка номер {{$id}}</h1>
    <div class="appeal card p-3">
        <ul class="list-group list-group-flush">
            <li class="list-group-item appeal-crash"><b>Тип неисправности:</b> Сфетофор не горит</li>
            <li class="list-group-item appeal-comment"><b>Комментарий: </b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab assumenda cum deleniti dignissimos dolorem dolores ducimus ea et fugit inventore ipsum laborum magnam, minima nesciunt officia, qui ratione temporibus velit.</li>
            <li class="list-group-item appeal-responsible">
                <h3>Выбор статуса</h3>
                <form action="">
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-secondary" type="button">назначить</button>
                        <select class="form-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                            <option selected>В работе</option>
                            <option value="1">Отмена</option>
                            <option value="2">Завершено</option>
                        </select>
                    </div>
                </form>

            </li>
            <li class="list-group-item appeal-responsible">
                <h3>Выбор отвественного</h3>
                <form action="">
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-secondary" type="button">назначить</button>
                        <select class="form-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                            <option selected>Иванов</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </form>

            </li>
        </ul>
    </div>

@endsection
