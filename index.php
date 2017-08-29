<?php
require_once 'core/core.php';
require_once 'classes/db.class.php';
if (isAuthorized()) {
    redirect('index');
}
$errors = [];
if (isPost()) {
    if(login(getParam('login'), getParam('password'))) {
        // Редирект на админ-панель
        redirect('index');
    } else {
        $errors[] = 'Некорректный логин или пароль';
    }
}
if($_POST['reg']){
    header('Location: add_user.php');
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Вход</h3>
                </div>
                <div class="panel-body">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <form accept-charset="UTF-8" role="form" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Login" name="login" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Вход">
                            <input class="btn btn-lg btn-success btn-block" type="submit" name="reg" value="Регистрация">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>