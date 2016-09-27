<?php

/**
 * Interface do Banco de Dados do Sistema
 *
 * Deve ser implementada com metodos para utilizar
 * o banco de dados desejado.
 * 
 * Todos os parametros das Queries serao informados internamente
 * (conforme a classe exemplo PgSQLQueries) para serem "bindados"
 * pelo PDO.
 *
 */
interface DBQueries {

    public function get_eventos();
    
    public function insert_evento();
    
    public function alter_evento();
    
    public function delete_event();
}
