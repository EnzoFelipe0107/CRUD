<?php
// Constantes de conexão: Fáceis de alterar e acessíveis globalmente.
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('BASE', 'cadastro');

/**
 * Conn Class (Padrão Singleton)
 * Garante que haverá apenas uma única conexão PDO ativa.
 */
class Conn {
    // Variável estática que armazena a única instância de conexão.
    private static $instance = null;

    // Métodos privados para impedir a criação direta ou cópia da classe (garantindo o Singleton).
    private function __construct() { } 
    private function __clone() { }

    /**
     * Retorna a instância única da conexão PDO.
     *
     * @return PDO Objeto de conexão com o banco de dados.
     */
    public static function getConnection() {
        // Verifica se a conexão (instância) já existe.
        if (self::$instance === null) {
            try {
                // Monta a string DSN (Data Source Name).
                $dsn = 'mysql:host=' . HOST . ';dbname=' . BASE . ';charset=utf8mb4';

                // Configurações de PDO para segurança e comportamento robusto.
                $options = [
                    // Configura o PDO para lançar exceções em caso de erros SQL.
                    PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION,
                    // Define o retorno padrão como array associativo.
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    // Desativa a emulação de prepared statements (melhora a segurança).
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                // Cria a nova conexão PDO e armazena na instância estática.
                self::$instance = new PDO($dsn, USER, PASS, $options);

            } catch (\PDOException $e) {
                // Interrompe a execução e exibe falha na conexão.
                die("Database connection failed: " . $e->getMessage());
            }
        }
        // Retorna a instância única e existente.
        return self::$instance;
    }
}
?>  