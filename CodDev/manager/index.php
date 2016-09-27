<?php

if (!defined("PATH")) {
    define('PATH', '/CodDev/');
}
require_once ('/../libs/php/aplicacao.php');
AC::__autoload();

Session::getInstance();

if (sizeof($_GET) == 0) {
    if (!empty($_GET['dest'])) {
        AC::_include("login/index.php?page=" . $_GET['dest']);
    } else {
        AC::_include("login/index.php");
    }
} else {

    foreach ($_GET as $key => $value) {
        if (empty($value)) {
            $value = 'index.php';
        }

        switch ($key) {
            case AC::K_NEED_LOGIN:
                if (!empty($_GET['dest'])) {
                    AC::_include("login/index.php?page=" . $_GET['dest']);
                } else {
                    AC::_include("login/index.php");
                }
                break;
            case AC::K_REG_LOGIN:
                AC::_include("login/reg_log.php");
                break;
            case AC::K_LOGOUT:
                AC::_include("logout/index.php");
                break;
            case AC::K_RED_MOD:
                if (!empty($value) && ($path = AC::is_module_path($value))) {
                    AC::_include($path);
                }
                break;
            case AC::K_RED_PAGE:

                if (!empty($value) && ($path = AC::is_module_path($value))) {
                    AC::_include($path);
                }
                break;
            case AC::K_DIALOG:
                if (!empty($value) && ($path = AC::is_dialog_path($value))) {
                    AC::_include($path);
                }
                break;
            case AC::K_RED_ONLY:
                if (!empty($value)) {
                    AC::_include($value);
                }
                break;
            default:
        }
    }
}
?>
