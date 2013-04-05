<?
class EntrepriseModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find_all()
	{
		return $this->db->query('SELECT id, nom FROM entreprises');
	}
	function find($id)
	{
		return $this->db->query("
			SELECT nom, site, logo
			FROM entreprises
			WHERE entreprises.id = $id
			LIMIT 1
		")->fetch();
	}
	function branches($id)
	{
		return $this->db->query("
			SELECT tel, adr, cities.nom as ville
				FROM branches
				JOIN cities ON cities.id = branches.city_id
				WHERE entreprise_id = $id
		");
	}
};
