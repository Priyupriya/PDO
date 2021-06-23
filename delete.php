<?php
require 'db.php';
$id = $_GET['id'];
$sql= 'DELETE from people where id=:id';
$statement = $conn->prepare($sql);
if($statement->execute(['id' => $id])){
	header("location:/");
}

?>