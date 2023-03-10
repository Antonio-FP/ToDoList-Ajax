<?php 

include('db.php');

$mdtaskTask = $_POST["mdtaskTask"];
$mdtaskId = $_POST["mdtaskId"];


$statement = $pdo->prepare("UPDATE tasks SET task=:mdtaskTask WHERE cid=:mdtaskId");
$statement->bindParam(':mdtaskTask', $mdtaskTask);
$statement->bindParam(':mdtaskId', $mdtaskId);


$statement->execute();

echo "done";


?>

