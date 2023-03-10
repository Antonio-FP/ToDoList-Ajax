<?php 

include('db.php');

$name = $_POST["name"];
$task = $_POST["task"];
$uniqid = $_POST["uniqid"];


$statement = $pdo->prepare("INSERT INTO tasks (cid, name, task) VALUES (:cid, :name, :task)");

$name = htmlentities($name, ENT_QUOTES);
$task = htmlentities($task, ENT_QUOTES);
         
$statement->bindParam(':cid', $uniqid);
$statement->bindParam(':name', $name);
$statement->bindParam(':task', $task);

$statement->execute();

echo "done";


?>

