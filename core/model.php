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
		$dsn = "{$engine}:dbname={$db};host={$host}"; //data source name
		$this->db = new PDO($dsn, $user, $pass);
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}
};