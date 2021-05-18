<?php
$dsn = 'mysql:host=localhost;dbname=test_pdo';
$username = 'root';
$password = '';
$options = []; 

try{
$connection = new PDO($dsn,$username,$password,$options);
echo 'connection successful';
}catch(PDOException $e){

}


?>
<!--dsn data source name-->