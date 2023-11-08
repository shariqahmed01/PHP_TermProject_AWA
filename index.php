<?php
// Start session management and include necessary functions
session_set_cookie_params(24 * 60 * 60);
session_start();
require_once('model/pdo.php');



if (isset($_COOKIE['visit_count'])) {
    $visitCount = $_COOKIE['visit_count'] + 1;
} else {
    $visitCount = 1;
}

// Set the tracking cookie with the updated visit count
setcookie('visit_count', $visitCount, time() + 86400);


if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else if (!isset($_SESSION['action'])) {
    $action = "login";
} else {
    $action = $_SESSION['action'];
}


// Perform the specified action
switch ($action) {
    case 'login':
        //In case login was successful
        //header("Location: .");
        if (isset($_SESSION['email'])) {
            $_SESSION['action'] = 'show_admin_menu';
        } else {
            $_SESSION['action'] = "login";
            $login_message = "You must login to view this page.";
        }
        //In case ogin was not successful
        include('view/login.php');
        break;
    case 'show_admin_menu':
        if (isset($_SESSION['email'])) {
            $_SESSION['action'] = 'show_admin_menu';
        } else {
            $_SESSION['action'] = "login";
            $login_message = "You must login to view this page.";
        }
        include('view/admin_menu.php');
        break;
    case 'show_users':
        if (isset($_SESSION['email'])) {
            $_SESSION['action'] = 'show_users';
        } else {
            $_SESSION['action'] = "login";
            $login_message = "You must login to view this page.";
        }
        include('view/users.php');
        break;
    case 'show_product':
        if (isset($_SESSION['email'])) {
            $_SESSION['action'] = 'show_product';
        } else {
            $_SESSION['action'] = "login";
            $login_message = "You must login to view this page.";
        }
        include('view/product.php');
        break;
    case 'logout':
        //Session destory
        session_destroy();
        $login_message = 'You have been logged out.';
        include('view/login.php');
        break;
}
