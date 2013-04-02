<?
class EntrepriseModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function findAll()
	{
		return $this->db->query('
			SELECT nom, adresse, tel, logo, cities.nom FROM entreprises
		');
	}
	function find($id)
	{
		return $this->db->query("
			SELECT 
				entreprises.nom, 
				adresse, 
				tel, 
				logo,
				GROUP_CONCAT(cities.nom SEPARATOR ', ') as villes
			FROM entreprises
				JOIN cities ON entreprises.city_id = cities.id
				JOIN countries ON cities.country_id = countries.id
			WHERE entreprises.id = $id
			LIMIT 1
		")->fetch();
	}
};
