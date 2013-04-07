<?
class TechnologyModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find_all()
	{
		return $this->db->query('
			SELECT id, nom, COUNT(technology_stage.stage_id) as stages
			FROM technologies
				LEFT JOIN technology_stage
					ON technology_stage.technology_id = technologies.id
			GROUP BY technologies.id
		');
	}
	function find_name($id)
	{
		return $this->db->query("
			SELECT nom FROM technologies WHERE id = $id
		")->fetch()['nom'];
	}
	function find_stages($id)
	{
		return $this->db->query("
			SELECT
				entreprises.id AS eid,
				entreprises.nom AS entreprise, 
				stages.duree * 15 AS duree,
				stages.date AS date,
				cities.nom AS ville
			FROM technologies
				JOIN technology_stage ON technology_stage.technology_id=technologies.id
				JOIN stages ON stages.id = technology_stage.stage_id
				JOIN branches ON branches.id = stages.branch_id
				JOIN cities ON cities.id = branches.city_id
				JOIN entreprises ON entreprises.id = branches.entreprise_id
			WHERE technologies.id = $id
		");
	}
	function create()
	{
		//TODO: sanitize
		return $this->db->query("
			INSERT INTO technologies VALUES(NULL, '{$_GET['nom']}')
		");
	}
};
