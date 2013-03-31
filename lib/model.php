<?
class Model extends PDO {
	protected $db;
	protected $model;
	function __construct() {
		$host = 'localhost'; 
		$engine = 'mysql'; 
		$db = 'stages'; 
		$user = 'root'; 
		$pass = '1234'; 
		$dns = "{$engine}:dbname={$db};host={$host}"; 
		$this->db = new PDO($dns, $user, $pass);
	}
};
