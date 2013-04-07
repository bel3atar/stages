<?
class TechnologyModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find_all()
	{
		return $this->db->query('SELECT id, nom FROM technologies');
	}
	function find($id)
	{
		return $this->db->query("
			SELECT nom FROM technologies WHERE id = $id
		")->fetch();
	}
};
