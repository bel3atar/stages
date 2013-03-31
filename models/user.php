<?
class UserModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find($id)
	{
	}
	function findAll()
	{
		return $this->db->query('SELECT * FROM users');
	}
};
