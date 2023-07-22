<?php
class Connection
{
    private static $bd;
    private static $drive = "mysql";
    private static $host = "localhost";
    private static $dbname = "notas2023";
    private static $user = "root";
    private static $password = "";

    public static function getConnection()
    {
        if (!isset(self::$bd)) {
            try {
                self::$bd = new PDO(
                    self::$drive . ":host=" . self::$host . ";dbname=" . self::$dbname,
                    self::$user,
                    self::$password
                );
                self::$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Conexión exitosa";
            } catch (PDOException $e) {
                echo "No se puede realizar la conexión: " . $e->getMessage();
            }
        }
        return self::$bd;
    }
}
?>
