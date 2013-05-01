<?
class Model extends PDO {
	public $db;
	function __construct() {
		$engine = DB_ENGINE;
		$user = DB_USER;
		$pass = DB_PASS;
		$host = DB_HOST;
		$db = DB_NAME;
		//date source name
		$dsn = "{$engine}:dbname={$db};host={$host};charset=utf8";
		$this->db = new PDO($dsn, $user, $pass);
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
	}
};
