<?php
include_once __DIR__.'/../classes/db.class.php';
include_once __DIR__.'/../core/core.php';

$db_host = '127.0.0.1:3306';
$db_user = 'root';
$db_password = '';
$db_name = 'todo';

$DBUsers = [];

try {

    $db = new DB($db_host, $db_user, $db_password, $db_name);

    $DBUsers = $db->query("SELECT * FROM users");

} catch (Exception $e) {
    echo $e->getMessage() . ':(';
}

$_SESSION = $DBUsers;

/**
 * Получает список пользователей из файла данных
 * @return array|mixed
 */
function getUsers()
{
    if (!empty($_SESSION)) {
        return $_SESSION;
    }else{
        echo 'Пришел пустой массив $_SESSION';
    }
}
/**
 * Получает пользователя по логину равному $login
 * @param $login
 * @return mixed|null
 */
function getUser($login)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['login'] == $login) {
            return $user;
        }
    }
    return null;
}
/**
 * Выполняет механизм аутоидентификации
 * @param $login
 * @param $password
 * @return bool
 */
function login($login, $password)
{
    $user = getUser($login);
    if ($user && $user['password'] == $password) {
        unset($user['password']);
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}


/**
* Добавление нового пользователя
* @param $login
* @param $password
* @param $name
* @return bool|int
    */
function addUser($login, $password, $name)
{
    $users = getUsers();
    // Находим максимальный ID и прибавляем к нему 1
    $id = max(array_column($users, 'id')) + 1;
    $users[] = [
        'id' => $id,
        'login' => $login,
        'password' => $password,
        'name' => $name,
    ];
    $db_host = '127.0.0.1:3306';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'todo';

    try {

        $db = new DB($db_host, $db_user, $db_password, $db_name);

        $db->query("INSERT INTO `users`(`id`, `login`, `password`, `name`) VALUES ($id,'$login',$password,'$name')");

    } catch (Exception $e) {
        echo $e->getMessage() . ':(';
    }

}


/**
 * Проверяет авторизован ли пользователь
 * @return bool
 */
function isAuthorized()
{
    return !empty($_SESSION['user']);
}
/**
 * Получаем текущего авторизованного пользователя
 * @return mixed
 */
function getCurrentUser()
{
    return $_SESSION['user'];
}
/**
 * Разлогивания пользователя
 */
function logout()
{
    session_destroy();
}

/**
 * Проверка на запрос типа POST
 * @return bool
 */
function isPost()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}
/**
 * Получаем параметры $_GET или $_POST по имени $name
 * @param $name
 * @return null
 */
function getParam($name) {
    return isset($_REQUEST[$name]) ? $_REQUEST[$name] : null;
}
/**
 * Осуществляет редирект на указанную страницу
 * @param $action
 */
function redirect($action)
{
    header('Location: ' . $action . '.php');
    die;
}