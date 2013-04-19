<?
class Model extends PDO {
	public $db;
	protected $model;
	function __construct() {
		$host = 'localhost'; 
		$engine = 'mysql'; 
		$db = 'stages'; 
		$user = 'root'; 
		$pass = '1234'; 
		//date source name
		$dsn = "{$engine}:dbname={$db};host={$host};charset=utf8";
		$this->db = new PDO($dsn, $user, $pass);
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
	}
};
