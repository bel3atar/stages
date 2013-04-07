<?
class StageModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function fetchEntreprises()
	{
		return $this->db->query('SELECT nom FROM entreprises');
	}
	function findAll($page = 0)
	{
		return $this->db->query("
			SELECT
				entreprises.id AS eid,
				entreprises.nom AS entreprise,
				stages.date AS date,
				stages.duree * 15 AS duree,
				cities.nom AS ville,
				countries.nom AS pays,
				GROUP_CONCAT(technologies.nom SEPARATOR ', ') AS techs
			FROM stages
				JOIN branches ON stages.branch_id = branches.id
				JOIN entreprises ON entreprises.id = branches.entreprise_id
				JOIN cities ON branches.city_id = cities.id
				JOIN countries ON cities.country_id = countries.id
				JOIN technology_stage ON technology_stage.stage_id = stages.id
				JOIN technologies ON technology_stage.technology_id = technologies.id
			GROUP BY stages.id
		");
	}
};	

