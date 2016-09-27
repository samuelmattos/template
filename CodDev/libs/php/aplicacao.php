<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of APP
 * @author Samuel
 */

/**
 * Auto Load
 * Carrega automaticamente os arquivos requisitados (atraves de chamadas as classes),
 * buscando dentro da library do sistema e do modulo.
 * @param String $className
 * @return boolean
 */
function __autoload($className) {

    $class_path = array(
        PATH . "libs/php",
        PATH . "libs/php/template",
        PATH . "libs/php/db",
        PATH . "libs/php/models",
        PATH . "modulos/ac/home/lib/php",
        PATH . "modulos/ac/home/lib/php/template"
    );

    // Nao usa Session porque ainda esta montando o __autoload    
    foreach ($class_path as $path) {
        if (file_exists("$path/$className.php")) {
            require_once("$path/$className.php");
            return true;
        }
    }
    return false;
}

/**
 * inicialmente usei AC nesta classe para referenciar o nome do projeto Ajuda Certa
 */
class AC {

    const NOME_APP = 'DevCog';
    //SESSION KEYS
    const K_CURRENT_MODULE = "AC_CURRENT_MODULE";
    const K_CURRENT_USER = "AC_CURRENT_USER";
    const K_MODULE_LOADED = "MODULE_IS_LOADED";
    //REDIRECTION
    const K_NEED_LOGIN = "login";   // redirect to login window
    const K_REG_LOGIN = "reg_log"; // redirect to login register
    const K_INICIO = "inicio";  // redirect to home page
    const K_LOGOUT = "logout";  // redirect to logout page
    const K_RED_MOD = "mod";     // redirect to module
    const K_RED_PAGE = "page";     // redirect to module
    const K_RED_UNI = "uni";     // redirect to "unidade" home page
    const K_RED_ONLY = "redir";   // redirect to the informed page
    const K_DIALOG = "dialog";  // redirect to the informed page
    const K_ERROR = "dialog=error_dialog"; // redirect to the informed page
    const K_TRIAGEM_TOUCH = "triagemtouch"; // redirect to the informed page
    // PATHS
    const K_MODULES_PATH = "";
    // ERRORS
    const K_LOGIN_ERROR = "LOGIN_ERROR";

    public static function _include($param) {

        $a = explode('?', $param);
        $url = $a[0];

        if (file_exists($url)) {

            if (sizeof($a) >= 2) {
                foreach (explode('&', $a[1]) as $p) {
                    $vv = explode('=', $p);
                    $_GET[$vv[0]] = urlencode($vv[1]);
                }
            }

            $url = realpath($url);

            $base = dirname(realpath($_SERVER['SCRIPT_FILENAME']));

            // Verificação de Seguranca
            // Checa se o arquivo a ser incluso esta na pasta(ou em uma subpasta) a aplicação

            if (strpos($url, $base) === 0) {
                include($url);
            }
        } else {
            die($url);
        }
    }

    public static function is_module_path($mod_path) {
        $a = explode('.', $mod_path);
        if (sizeof($a) == 2) {
            $path = AC::K_MODULES_PATH . "" . $a[0] . "/" . $a[1];
            if (file_exists($full_path = "$path/index.php")) {
                return $full_path;
            } else if (file_exists($full_path = "$path/default.php")) {
                return $full_path;
            }
        }
    }

    public static function check_access($user) {
        if ($user == null) {
            AC::_include("login/index.php");
            exit();
        }
        if (!AC::is_logged()) {
            AC::force_login();
        }
    }

    public static function has_access(Modulo $modulo) {
        if (AC::is_logged()) {
            $usuario = AC::get_current_user();
            $unidade = $usuario->get_unidade();
            $id_usu = $usuario->get_id();

            if ($modulo->is_global()) {
                return DB::getInstance()->has_access_global($id_usu, $modulo->get_id());
            } else {
                // unidade não informada, mas o módulo NÂO é global
                if ($unidade == null) {
                    throw new Exception("A permissão para módulos não globais depende da unidade.");
                }
                // módulo unidade
                return $usuario->get_lotacao()->get_cargo()->has_permissao($modulo->get_id());
            }
        }
        return false;
    }

    public static function force_login() {
        header("Location:./?" . AC::K_NEED_LOGIN);
    }

    public static function check_login($mod_key) {
        AC::check_access($mod_key);
    }

    public static function is_logged() {
        return Session::getInstance()->exists(AC::K_CURRENT_USER);
    }

    public static function import($param) {
        return AC::_include($param);
    }

    public static function get_current_url() {
        return $_SERVER['PHP_SELF'];
    }

    public static function get_current_page() {
        $url = AC::get_current_url();
        return end(explode('/', $url));
    }

    public static function is_dialog_path($dialog_name) {
        // aceitar somente nomes com caracters alpha numericos + underline
        if (ctype_alnum(str_replace('_', 'a', $dialog_name))) {
            if (file_exists($full_path = "dialogs/$dialog_name.php")) {
                return $full_path;
            }
        }
        return false;
    }

    /*
     * Retorna a data e hora (a partir da string passada por parametro)
     * @return String
     */

    public static function get_date($date) {
        return date($date, time());
    }

    public static function __autoload() {

        require_once PATH . '../../libs/php/core/db/DB.php';
        require_once PATH . '../../libs/php/core/Config.php';
        require_once PATH . '../../libs/php/core/db/PgSQLDB.php';
        require_once PATH . '../../libs/php/core/db/PgSQLQueries.php';
        require_once PATH . '../../libs/php/core/Evento.php';
        require_once PATH . '../../libs/php/core/contrib/PHPMailer/class.phpmailer.php';
        require_once PATH . '../../libs/php/core/contrib/PHPMailer/class.pop3.php';
        require_once PATH . '../../libs/php/core/contrib/PHPMailer/class.smtp.php';
        require_once PATH . '../../libs/php/core/models/Session.php';
        require_once PATH . '../../libs/php/core/models/Login.php';
        require_once PATH . '../../libs/php/core/models/Usuario.php';
        require_once PATH . '../../libs/php/template/Template.php';
        require_once PATH . "../../manager/ac/home/lib/php/template/THome.php";
    }

}

?>
