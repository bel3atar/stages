<?
class CityModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function exists($id)
	{
		$q = $this->db->prepare('
			SELECT EXISTS(SELECT 1 FROM cities WHERE id = ? LIMIT 1)
		');
		$q->execute([$id]);
		return $q->fetchColumn();
	}
	function find($id)
	{
		$q = $this->db->prepare('SELECT nom FROM cities WHERE id = ? LIMIT 1');
		$q->execute([$id]);
		return $q->fetch()['nom'];
	}
	function find_all()
	{
		return $this->db->query('
			SELECT 
				cities.id AS id, cities.nom AS nom, COUNT(stages.id) AS stages
			FROM cities LEFT JOIN stages ON stages.city_id = cities.id    
			GROUP BY cities.id
		');
	}
	function create()
	{
		$q = $this->db->prepare('INSERT INTO cities (nom) VALUES (?)');
		return $q->execute([strip_tags($_GET['nom'])]);
	}
	function stages($id)
	{
		$q = $this->db->prepare('
			SELECT
				entreprises.nom AS entreprise,
				entreprises.id AS entrepriseid,
				stages.date AS date,
				stages.duree * 15 AS duree,
				GROUP_CONCAT(technologies.id SEPARATOR \',\') AS tids,
				GROUP_CONCAT(technologies.nom SEPARATOR \',\') AS tnames
			FROM stages
				     JOIN entreprises      ON entreprises.id = stages.entreprise_id
				LEFT JOIN technology_stage ON technology_stage.stage_id = stages.id
				LEFT JOIN technologies     ON technologies.id = technology_stage.technology_id	
			WHERE stages.city_id = ?
			GROUP BY stages.id
		');
		$q->execute([$id]);
		return $q->fetchAll();
	}
	function update($params)
	{
		$q = $this->db->prepare('UPDATE cities SET nom = ? WHERE id = ? LIMIT 1');
		return $q->execute([strip_tags($params['nom']), $params['id']]);
	}
	function destroy($id)
	{
		$q = $this->db->prepare('DELETE FROM cities WHERE id = ? LIMIT 1');
		return $q->execute([$id]);
	}
};
