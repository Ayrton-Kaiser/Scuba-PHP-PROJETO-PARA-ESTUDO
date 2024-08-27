<?php

/*$page = ($_GET['page'] ?? 'login'); //aqui ele está utilizando a URL para pegar qual a página se trata, na aba de login.

switch ($page) { //verificando cada parte da página que muda caso o formulário mude
    case 'register':
        doRegister();
        break;
    case 'login':
        doLogin();
        break;

    default:
        do_not_found();
        break;
}*/

/*include 'controller.php';

$controller = new Controller;

$page = $_GET['page'] ?? 'login';

switch ($page) {
    case 'login':
        $controller->do_Login();
        break;
    case 'register':
        $controller->do_Register();
        break;
    default:
        $controller->do_Not_Found();
        break;
}*/

//revisao aula
function guest_routes()
{
    $page = $_GET['page'] ?? 'login';
    switch ($page) {
        case 'login':
            do_login();
            break;
        case 'forget-password':
            do_forget_password();
            break;
        case 'change-password':
            do_change_password();
            break;
        case 'register':
            do_register();
            break;
        case 'mail-validation':
            do_validation();
            break;
        default:
            do_not_found();
            break;
    }
}

function auth_routes()
{
    $page = $_GET['page'] ?? 'home';
    switch ($page) {
        case 'home':
            do_home();
            break;
        case 'logout':
            do_logout();
            break;
        case 'delete-account':
            do_delete_account();
            break;
        default:
            do_not_found();
            break;
    }
}
