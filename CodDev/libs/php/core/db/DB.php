<?php

/**
 * Classe DB
 * Responsavel pela abstracao do Banco de Dados
 */
abstract class DB {

    /** Mantem um instancia unica dessa classe */
    private static $instance;

    /** Objeto que retorna as queries apropriadas a um banco específico(MySQL, PostgreSQL, Oracle...) */
    private $m_queries;

    /** Conexão com o banco de dados */
    private $m_connection;

    /**
     * Singleton
     * @return DB
     */
    public static function getInstance() {
        if (DB::$instance === null) {
            $db_class = Config::DB_CLASS;
            DB::$instance = new $db_class;
        }
        return DB::$instance;
    }

    /**
     * Conecta ao banco
     */
    public abstract function connect($host, $port, $usuario, $senha, $banco);

    /**
     * @param DBQueries
     */
    public function set_queries(DBQueries $queries) {
        $this->m_queries = $queries;
    }

    /**
     * @return DBQueries
     */
    public function get_queries() {
        return $this->m_queries;
    }

    /**
     * @return PDO
     */
    public function get_connection() {
        return $this->m_connection;
    }

    /**
     * @return PDO
     */
    public function set_connection(/* PDO */ $pdo) {
        $this->m_connection = $pdo;
    }

    /**
     * Transforma um resultset em array
     * @param PDOStatement statement
     * @return array
     */
    public function to_array($statement) {
        return $statement->fetchAll();
    }

    public function create_evento($linha) {
        $id_evento = $linha['ID_EVENTO'];
        $descricao = $linha['DESCRICAO'];
        $local = $linha['ENDERECO'];
        $dt_ini = $linha['DT_INI'];
        $dt_fim = $linha['DT_FIM'];

        $evento = new Evento($id_evento, $descricao, $local, $dt_ini, $dt_fim);
        return $evento;
    }

    /**
     * @param STR $descricao
     * @param STR $endereco
     * @param STR $dt_ini
     * @param STR $dt_fim
     */
    public function insert_event($descricao, $endereco, $dt_ini, $dt_fim) {
        $sql = $this->get_queries()->insert_evento();
        $statement = $this->get_connection()->prepare($sql);
        $statement->bindValue(":descricao", $descricao, PDO::PARAM_STR);
        $statement->bindValue(":endereco", $endereco, PDO::PARAM_STR);
        $statement->bindValue(":dt_ini", $dt_ini, PDO::PARAM_STR);
        $statement->bindValue(":dt_fim", $dt_fim, PDO::PARAM_STR);
        $statement->execute();
    }

    /**
     * @param INT $id_evento
     * @param STR $descricao
     * @param STR $dendereco
     * @param STR $dt_ini
     * @param STR $dt_fim
     */
    public function alter_event($id_evento, $descricao, $dendereco, $dt_ini, $dt_fim) {
        $sql = $this->get_queries()->alter_event();
        $statement = $this->get_connection()->prepare($sql);
        $statement->bindValue(":id_evento", $id_evento, PDO::PARAM_INT);
        $statement->bindValue(":descricao", $descricao, PDO::PARAM_STR);
        $statement->bindValue(":local", $dendereco, PDO::PARAM_STR);
        $statement->bindValue(":dt_ini", $dt_ini, PDO::PARAM_STR);
        $statement->bindValue(":dt_fim", $dt_fim, PDO::PARAM_STR);
        $statement->execute();
    }

    /**
     * @param INT $id_enveto
     */
    public function delete_event($id_enveto) {
        $sql = $this->get_queries()->delete_event();
        $statement = $this->get_connection()->prepare($sql);
        $statement->bindValue(":id_evento", $id_evento, PDO::PARAM_INT);
    }

    /**
     * Retorna os eventos que estão com da data maior do que o dia de hoje
     * @return Array Evento
     */
    public function get_eventos() {
        $sql = $this->get_queries()->get_eventos();
        $statement = $this->get_connection()->prepare($sql);
        $statement->execute();
        $list = DB::to_array($statement);

        $eventos = [];
        foreach ($list as $linha) {
            $evento = $this->create_evento($linha);
            $eventos[] = $evento;
        }

        return $eventos;
    }

    /**
     * Retorna os eventos que estão com da data maior do que o dia de hoje
     * Json
     * @return Array Evento
     */
    public function get_eventos_json() {
        $sql = $this->get_queries()->get_eventos();
        $statement = $this->get_connection()->prepare($sql);
        $statement->execute();
        return DB::to_array($statement);
    }

}
