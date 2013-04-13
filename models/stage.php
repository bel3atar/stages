<?
class StageModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function entreprises()
	{
		return $this->db->query('SELECT id, nom FROM entreprises');
	}
	function users()
	{
		return $this->db->query('
			SELECT id, CONCAT_WS(\' \', nom, prenom) AS nom FROM users
		');
	}
	function cities()
	{
		return $this->db->query('SELECT id, nom FROM cities');
	}
	function find_all()
	{
		return $this->db->query('
			SELECT
				GROUP_CONCAT(technologies.id  SEPARATOR \',\') AS techids,
				GROUP_CONCAT(technologies.nom SEPARATOR \',\') AS techs,
				CONCAT_WS(\' \', users.nom, users.prenom) AS nom,
				entreprises.nom AS entreprise,
				stages.duree * 15 AS duree,
				entreprises.id AS eid,
				cities.id AS idville,
				stages.date AS date,
				cities.nom AS ville,
				users.id AS uid
			FROM stages
				JOIN cities        ON    stages.city_id     =             cities.id
				JOIN users          ON   stages.student_id     =           users.id
				JOIN entreprises     ON  stages.entreprise_id     =  entreprises.id
				JOIN technology_stage ON technology_stage.stage_id   =    stages.id
				JOIN technologies      ON technology_stage.technology_id=technologies.id
			GROUP BY stages.id
		');
	}
};	

