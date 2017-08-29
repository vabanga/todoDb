<?php
require_once 'core/core.php';

if (isPost()) {
    if(addUser(getParam('login'), getParam('password'), getParam('name'))) {
        redirect('index');
    } else {
        // TODO выводим ошибки....
    }
    header('Location: index.php');
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
                    <h3 class="panel-title">Добавление нового пользователя</h3>
                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Login" name="login" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="text" value="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="name" type="text" value="">
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Добавить">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>