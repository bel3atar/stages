<?
class CityModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find_all()
	{
		return $this->db->query('
			SELECT 
				cities.id, 
				cities.nom, 
				COUNT(stages.id) as stages,
				COUNT(DISTINCT entreprises.id) as entreprises
			FROM cities
				JOIN branches ON branches.city_id = cities.id
				JOIN stages ON stages.branch_id = branches.id
				JOIN entreprises ON branches.entreprise_id = entreprises.id
			GROUP BY stages.id, entreprises.id
		');
	}
};
