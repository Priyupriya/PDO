<?php
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => getenv('PDO_DB_HOST'),
        'username' => 'root',
        'password' => getenv('PDO_DB_PASSWORD'),
        'db' => getenv('PDO_DB_NAME'),
    )
	);


class DB_connection {
	private $pdo;
	 private function __construct($config_options = []){
		
			// $config_options = [
			// $dbname => Config::get('mysql/db'),
			// $username => Config::get('mysql/username'),
			// $password => Config::get('mysql/password'),
			// $host =>Config::get('mysql/host'),
			// ];
			// $config = array_replace($config_options, $config);
			// $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
		// try {
			// $pdo = new PDO($dsn, $username, $password);
			// echo "DB connection successful";

		// } catch (PDOException $e){
			// echo "Error!: " . $e->getMessage() . "<br/>";
		// }	
		
	 }
		

}
$db = new DB_connection();

echo "connection successful";

//print_r($sql);	
	//echo "Error!: " . $e->getMessage() . "<br/>";


	// $dsn = 'mysql:host=localhost;dbname=test_pdo';
// $username = 'root';
// $password = '';
	  //$dsn = 'mysql:host='. $host .';dbname='. $dbname;
	  //$dsn = "mysql:dbname={$this->db};host:{$this->host}";
//var_dump($dsn);
// try{
// $connection = new PDO($dsn,$username,$password');
// echo 'connection successful';
// }catch(PDOException $e){
 // echo "Error!: " . $e->getMessage() . "<br/>";
// }
?>