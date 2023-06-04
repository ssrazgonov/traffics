<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style.css">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=ваш API-ключ&lang=ru_RU" type="text/javascript"></script>
</head>
<body>
    <header>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
              <div class="container-fluid">
                <a class="navbar-brand" href="#">Траффик свет</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">Перейти в панель управления</a>
                  </li>
            </ul>
        </div>
    </div>
</nav>
</div>
</header>
<main class="container-fluid">
    <div class="traffic-map">
        <div class="row">
            <div class="col-md-9">
                <div class="traffic-map" id="map"></div>
            </div>
            <div class="col-md-3">
                <form>
  <fieldset>
    <div class="alert alert-success" role="alert">
 Отсканируйте qr-код
</div>
    <div class="mb-3">
        <h3>Сообщение о неисправности светофора</h3>
    </div>
      <label for="select" class="form-label">Выберите неисправность</label>
      <select id="select" class="form-select">
        <option>Светофор не горит</option>
        <option>Светофор горит постоянно</option>
        <option>Светофор 'моргает' желтым светом</option>
        <option>Другая неисправность</option>
      </select>
    <div class="mb-3">
    </div>
    <label for="select" class="form-label">Комментарий</label>
    <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
    <div class="mb-3">
    </div>
    <button type="submit" class="btn btn-primary">Отправить сообщение</button>
  </fieldset>
</form>
            </div>
        </div>
    </div>
</div>
</main>
<footer class="text-center bg-body-tertiary">
    <div class="">
        <p>Дипломная работа</p>
    </div>
</footer>
<script type="text/javascript">

    var traffics = @json($traffic_lights);
    console.log(traffics);
</script>
<script src="/app.js"></script>
</body>
</html>
