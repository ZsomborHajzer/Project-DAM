<?

$dsn = "mysql:host=127.0.0.1;dbname=E3T";
$user = "root";
$passwd = "!User_12";

try {
    $dbHandler = new PDO($dsn, $user, $passwd);
} catch (PDOException $e) {
    echo "<script>console.log('Connection failed: " . $e->getMessage() . "');</script>";
    die();
}
