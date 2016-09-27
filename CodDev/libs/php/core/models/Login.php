<?php

/**
 * Classe Login
 * Responsavel pelo controle de acesso ao sistema
 *
 */
class Login {

    /**
     * Retorna se os dados informados tem ou nao acesso ao modulo
     *
     * @param String user
     * @param String pass
     * @return int (See AbstractDB::has_acesso())
     */
    public static function has_acesso($user, $pass) {
        if ($user == 'juadsjo' && $pass == 'juadsjo') {
            return -1;
        } else {
            return 1; // unknown user
        }
    }

}

?>
