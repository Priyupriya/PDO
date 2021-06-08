<?php

 $GLOBALS['config'] = array(
    'mysql' => array(
        'host' => getenv('PDO_DB_HOST'),
        'username' => 'root',
        'password' => getenv('PDO_DB_PASSWORD'),
        'db' => getenv('PDO_DB_NAME'),
    )
	);

class Config {
	public static function get($path = null){
		if($path){
			$config = $GLOBALS['config'];
			$path = explode('/', $path);

			foreach ($path as $bit) {
				if(isset($config[$bit])){
					$config = $config[$bit];
				} else {
					return false;
				}
			}

			return $config;
		}

		return false;
	}
	public $pdo;

	private static $_instance = null;
	private $_pdo, $_query, $_error = false, $_errorInfo, $_results=[], $_resultsArray=[], $_count = 0, $_lastId, $_queryCount=0;

	private function __construct($config = []){
		if (!$opts = Config::get('mysql/options'))
			$opts = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET SESSION sql_mode = ''");
		try{
			if($config == []){
				$this->_pdo = new PDO('mysql:host=' .
					Config::get('mysql/host') .';dbname='.
					Config::get('mysql/db') . ';charset=utf8',
					Config::get('mysql/username'),
					Config::get('mysql/password'),
					$opts);
			}
			//echo 'connection established';
		} catch(PDOException $e){
			die($e->getMessage());
		}

}
public static function getInstance(){
		if (!isset(self::$_instance)) {
			self::$_instance = new Config();
		}
		return self::$_instance;
	}

	public static function getDB($config){
			self::$_instance = new Config($config);
		return self::$_instance;
	}

	public function query($sql, $params = array()){
		#echo "DEBUG: query(sql=$sql, params=".print_r($params,true).")<br />\n";
		$this->_queryCount++;
		$this->_error = false;
		$this->_errorInfo = array(0, null, null); $this->_resultsArray=[]; $this->_count=0; $this->_lastId=0;
		if ($this->_query = $this->_pdo->prepare($sql)) {
			$x = 1;
			if (count($params)) {
				foreach ($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}

			if ($this->_query->execute()) {
				if ($this->_query->columnCount() > 0) {
					$this->_results = $this->_query->fetchALL(PDO::FETCH_OBJ);
					$this->_resultsArray = json_decode(json_encode($this->_results),true);
				}
				$this->_count = $this->_query->rowCount();
				$this->_lastId = $this->_pdo->lastInsertId();
			} else{
				$this->_error = true;
				$this->_errorInfo = $this->_query->errorInfo();
			}
		}
		return $this;
	}
}
//$db = new Config();
//$database = DB::conection;
//echo 'connction established';
//var_dump();
?>