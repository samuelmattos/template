<?php

define('MODULO', 'LOGIN');

try {
    /**
     *  1 = Usuario Invalido
     * 	3 = Senha Invalida
     */
    $erro = 0;
    Session::getInstance()->set(AC::K_LOGIN_ERROR, null);
    $messages = array(
        'Usuário Inválido.',
        '',
        'Senha Inválida.'
    );

    if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
        $user = $_POST['usuario'];
        $pass = $_POST['senha'];

        $erro = Login::has_acesso($user, $pass);

        if ($erro == -1) {
            $usuario = new Usuario($user, $endereco = 'Centro histórico', $bairro = 'centro', $cidade = 'são josé', $estado = 'sc');
            Session::getInstance()->setGlobal(AC::K_CURRENT_USER, $usuario);
            echo 0;
        } else {
            echo $messages[$erro - 1];
        }
    } else {
        header("Location:./?" . AC::K_NEED_LOGIN);
    }
} catch (Exception $e) {
    Template::display_exception($e);
}
?>
