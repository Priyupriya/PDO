<?php	
	$globaldb = $GLOBALS['config'] = array(
    'mysql' => array(
        'host' => getenv('PDO_DB_HOST'),
        'username' => 'root',
        'password' => getenv('PDO_DB_PASSWORD'),
        'db' => getenv('PDO_DB_NAME'),
		            
    ));
class DB{
	
	private $_config;
	function __construct (){
	global $stglobaldb;
	//$_config = array($globaldb['host']);
		
	}
}
$user = new DB;
$_con = $user->$_config;
var_dump($_con);
?>