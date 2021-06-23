<?php
	$globaldb = $GLOBALS['config'] = array(
    'mysql' => array(
        'host' => getenv('PDO_DB_HOST'),
        'username' => 'root',
        'password' => getenv('PDO_DB_PASSWORD'),
        'db' => getenv('PDO_DB_NAME'),
		            
    ));
	$keys = array_keys($globaldb);
 $arrlength=count($keys);
 $singleArray = [];
for($i = 0; $i < $arrlength; $i++) {
	 $glob= $globaldb[$keys[$i]];

	 foreach($glob as $key => $value) {
  //    echo "$key  :   $value  <br>";
	//		echo "The localhost {$key} is $value" . '<br>';
			$singleArray[] = $value;
			
}
}
			$host = $singleArray[0];
			$username = $singleArray[1];
			$password = $singleArray[2];
			$db = $singleArray[3];
			
 // var_dump($host);
 // var_dump($username);
 // var_dump($password);
 // var_dump($sb);
	// class DB


try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //  echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>