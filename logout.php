<?php
require_once 'core/core.php';
/*if (!isAuthorized()) {
    redirect('login');
}*/
logout();
redirect('login');