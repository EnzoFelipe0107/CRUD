<?php
// Database connection constants (kept outside the class for simple access via 'define')
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('BASE', 'cadastro');

/**
 * Conn Class (Singleton Pattern)
 * Ensures only one instance of the PDO connection exists throughout the application.
 *
 * Usage: $conn = Conn::getConnection();
 */
class Conn {
    private static $instance = null;

    // Private constructor to prevent direct instantiation
    private function __construct() { }
    // Private clone method to prevent cloning of the instance
    private function __clone() { }

    /**
     * Gets the single PDO connection instance.
     *
     * @return PDO The database connection object.
     */
    public static function getConnection() {
        // Only create a new connection if one doesn't already exist
        if (self::$instance === null) {
            try {
                // 1. Construct the Data Source Name (DSN)
                $dsn = 'mysql:host=' . HOST . ';dbname=' . BASE . ';charset=utf8mb4';

                // 2. Set PDO options for robust behavior
                $options = [
                    // Throw exceptions on errors (recommended for modern PHP)
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    // Set default fetch mode to associative array
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    // Disable emulation mode for prepared statements (better security and performance)
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                // 3. Create the PDO connection object
                self::$instance = new PDO($dsn, USER, PASS, $options);

                // Optional: Echo a success message (remove this in production)
                // echo "Connection successful!";

            } catch (\PDOException $e) {
                // Handle connection error
                // In a production environment, you would log this error and display a generic message
                die("Database connection failed: " . $e->getMessage());
            }
        }
        // Return the existing connection instance
        return self::$instance;
    }
}

// Now, to use the connection in another file (like salvar-usuario.php), 
// you would replace the procedural $conn = ... line with:
// $conn = Conn::getConnection();

/*
Example usage in salvar-usuario.php:
$conn = Conn::getConnection();
$sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento, cpf)
        VALUES (:nome,:email,:senha,:data_nasc,:CPF)";
$res = $conn->prepare($sql);
$res->bindValue(':nome', $nome, PDO::PARAM_STR);
// ... other binds
$res->execute();
*/
?>
