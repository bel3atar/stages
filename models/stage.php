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
				entreprises.id as eid,
				entreprises.nom as entreprise,
				stages.date as date,
				stages.duree as duree,
				cities.nom as ville,
				countries.nom as pays,
				GROUP_CONCAT(technologies.nom SEPARATOR ', ') as techs
			FROM stages
				JOIN people ON stages.proposer_id = people.id
				JOIN entreprises ON entreprises.id = people.entreprise_id
				JOIN cities ON stages.city_id = cities.id
				JOIN countries ON cities.country_id = countries.id
				JOIN technology_stage ON technology_stage.stage_id = stages.id
				JOIN technologies ON technology_stage.technology_id = technologies.id
			GROUP BY stages.id
		");
	}
};	

