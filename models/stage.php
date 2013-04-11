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
	function find_all($page = 0)
	{
		return $this->db->query("
			SELECT
				entreprises.id AS eid,
				entreprises.nom AS entreprise,
				stages.date AS date,
				stages.duree * 15 AS duree,
				cities.nom AS ville,
				cities.id AS idville,
				users.id AS uid,
				CONCAT_WS(' ', users.nom, users.prenom) AS nom,
				GROUP_CONCAT(technologies.nom SEPARATOR ',') AS techs,
				GROUP_CONCAT(technologies.id SEPARATOR ',') AS techids
			FROM stages
				JOIN branches ON stages.branch_id = branches.id
				JOIN entreprises ON entreprises.id = branches.entreprise_id
				JOIN cities ON branches.city_id = cities.id
				JOIN technology_stage ON technology_stage.stage_id = stages.id
				JOIN technologies ON technology_stage.technology_id = technologies.id
				JOIN users ON stages.student_id = users.id
			GROUP BY stages.id
			LIMIT 30
			OFFSET $page
		");
	}
};	

