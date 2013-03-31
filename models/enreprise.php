<?
class EntrepriseModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function findAll()
	{
		return $this->db->query('
			SELECT nom, adresse, tel, logo, cities.nom
			FROM entreprises
		');
	}
