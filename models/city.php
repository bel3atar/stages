<?
class CityModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find($id)
	{
		$q = $this->db->prepare('SELECT nom FROM cities WHERE id = ?');
		$q->execute([$id]);
		return $q->fetch()['nom'];
	}
	function find_all()
	{
		return $this->db->query('
			SELECT 
				cities.id AS id, 
				cities.nom AS nom, 
				COUNT(stages.id) AS stages,
				COUNT(DISTINCT entreprises.id) AS entreprises
			FROM cities
				LEFT JOIN branches ON branches.city_id = cities.id
				LEFT JOIN stages ON stages.branch_id = branches.id
				LEFT JOIN entreprises ON branches.entreprise_id = entreprises.id
			GROUP BY cities.id
		');
	}
	function create()
	{
		$q = $this->db->prepare('INSERT INTO cities(nom) VALUES(?)');
		return $q->execute([$_GET['nom']]);
	}
	function stages($id)
	{
		$q = $this->db->prepare("
			SELECT
				entreprises.nom AS entreprise,
				entreprises.id AS entrepriseid,
				stages.date AS date,
				stages.duree * 15 AS duree,
				GROUP_CONCAT(technologies.id SEPARATOR ',') AS tids,
				GROUP_CONCAT(technologies.nom SEPARATOR ',') AS tnames
			FROM stages
				JOIN branches ON branches.id = stages.branch_id
				JOIN entreprises ON entreprises.id = branches.entreprise_id
				JOIN technology_stage ON technology_stage.stage_id = stages.id
				JOIN technologies ON technologies.id = technology_stage.technology_id
				JOIN cities ON cities.id = branches.city_id
			WHERE cities.id = ?
			GROUP BY cities.id
		");
		$q->execute([$id]);
		return $q->fetchAll();
	}
};
