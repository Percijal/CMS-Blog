<?php
try {
    $conn = new PDO('sqlite:database\mydb.db');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$gettedId = $_GET["id"];

$sql = "DELETE FROM wpis WHERE id = $gettedId";
$query = $conn -> query($sql);
              
header("Location: ./index.php");
exit();
?>