<?php
try {
    $myPDO = new PDO('pgsql:host=192.168.56.104;dbname=trxndb', 'trxnuser', 'trxnpass');
} catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>
<?php
    $result = $myPDO->query("SELECT lastname FROM employees");
?>



<?php
/*
$servername = "localhost";
$username = "stef";
$password = "pass";

try {
    $conn = new PDO("mysql:host=$servername;dbname=mydb", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
*/
?>
