<?php

/**
 * Classe DB
 *
 * Responsavel pela abstracao do Banco de Dados
 *
 */
class PgSQLDB extends DB {

    // static
    /** Mantem um instancia unica dessa classe */
    private static $instance;
    // fields
    /** Objeto que retorna as queries apropriadas a um banco específico(PostgreSQL, MySQL, Oracle...) */
    private $m_queries;

    /**
     * Construtor private, evita que essa classe seja instanciada de fora formalizando seu uso atraves do singleton.
     * @return DB db
     */
    protected function __construct() {
        $this->connect(Config::DB_HOST, Config::DB_PORT, Config::DB_USER, Config::DB_PASS, Config::DB_NAME);
        // TODO instanciar a classe a partir do banco especificado
        $queries = "PgSQLQueries";
        $this->set_queries(new $queries);
    }

    /**
     * Conecta ao banco
     */
    public function connect($host, $port, $usuario, $senha, $banco) {
        try {
            $pdo = new PDO('pgsql:host=' . $host . ';port=' . $port . ';dbname=' . $banco, $usuario, $senha);
            $this->set_connection($pdo/* new ProfilePDO($pdo) */);
            $this->get_connection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->get_connection()->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
        } catch (PDOException $e) {
            // O trace da exception exibe a senha do banco(entre outros)
            // nao dar re-thrown!
            //exit("<pre><h1>ERRO FATAL</h1>\n\nErro conectando ao Banco de Dados\nMotivo: ".$e->getMessage()."\n\nPor motivos de segurança o Trace da exception não pode ser exibido.</pre>");
            exit("<pre style=\" text-align: center \" ><h1>Alerta!</h1>\nSistema temporariamente fora de uso.\nContate o adminstrador do sistema.</pre>");
        }
    }

    public function valor_current($nome_sequence) {
        return DB::getInstance()->get_connection()->lastInsertId($nome_sequence);
    }

}

?>
