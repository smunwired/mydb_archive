<?php
include '../leftmenu.php';
?>
<h2>Title Delete Post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "delete from title where id =" . $_GET["id"] ;

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the DELETE succeeded
    echo $stmt->rowCount() . " records DELETED successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
<p><a href="titlelst.php">titles</a></p>
