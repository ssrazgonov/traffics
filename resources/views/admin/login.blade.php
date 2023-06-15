<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <main class="d-flex justify-content-center align-items-center">

        <form action="{{route('auth-login')}}" method="post">
            @if($errors->has('message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$errors->first('message')}}
                </div>
            @endif

            <h1>Вход в систему мониторинга состояния светофоров</h1>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="form2Example1" class="form-control" name="email"/>
                <label class="form-label" for="form2Example1">Email адрес</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="form2Example2" class="form-control" name="password"/>
                <label class="form-label" for="form2Example2">Пароль</label>
            </div>

            </div>

            <!-- Submit button -->
            <button class="btn btn-primary btn-block mb-4">Войти</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Нет профиля? <a href="#!">Регистрация</a></p>
            </div>
        </form>
    </main>
</body>
</html>
