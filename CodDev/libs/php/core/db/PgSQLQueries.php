<?php

include_once 'DBQueries.php';

/**
 * Classe PgSQLQueries
 * contem as queries especificas do PgSQL
 * Implementacao do DBQueries para utilizar o Banco de Dados PgSQL
 */
class PgSQLQueries implements DBQueries {

    public function get_eventos() {
        return "SELECT id_evento, descricao, 
        endereco, to_char(dt_ini, 'DD/MM/YY HH24:MI') as dt_ini, 
        to_char(dt_fim, 'DD/MM/YY HH24:MI') as dt_fim 
        FROM evento WHERE dt_fim >= now() 
        ORDER BY dt_ini DESC";
    }

    public function insert_evento() {
        return "INSERT INTO evento(descricao, endereco, dt_ini, dt_fim)
                            VALUES (:descricao, :endereco, to_date(:dt_ini, 'DD/MM/YYYY'), to_date(:dt_ini, 'DD/MM/YYYY'))";
    }

    public function alter_evento() {
        return "UPDATE evento
                SET descricao = :descricao, endereco = :endereco, dt_ini = :dt_ini, dt_fim=:dt_fim
                WHERE id_evento = :id_evento";
    }

    public function delete_event() {
        return "DELETE FROM evento WHERE id_evento = :id_evento";
    }

}
