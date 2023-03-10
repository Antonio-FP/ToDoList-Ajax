<?php 

include('db.php');

$cid = $_POST["cid"];

$statement = $pdo->prepare("DELETE FROM tasks WHERE cid=:cid");

$statement->bindParam(":cid", $cid);

$statement->execute();

echo "$cid";


?>

