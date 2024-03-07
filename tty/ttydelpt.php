<?php
include '../trxnmenu.php';
include 'connect.php';
try { $sql = "delete from tran_type where tran_type_id =" . $_GET["ttyd"] ;
//echo $sql;
    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the DELETE succeeded
    echo $stmt->rowCount() . " records DELETED successfully<br/><a href=\"ttylst.php\">tran types</a>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

include '../sitemap.php';
?>

