<?php
require 'db.php';
$id = $_GET['id'];
$sql= 'DELETE from people where id=:id';
$statement = $connection->prepare($sql);
if($statement->excute([':id'=> $id])){
	header("location:/")
}

?>