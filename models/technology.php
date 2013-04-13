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
	function stages($id)
	{
		$q = $this->db->prepare('
			SELECT
				entreprises.id AS eid,
				entreprises.nom AS entreprise, 
				stages.duree * 15 AS duree,
				stages.date AS date,
				cities.nom AS ville,
				cities.id  AS ctid,
				CONCAT_WS(\' \', users.nom, users.prenom) AS etudiant,
				users.id AS uid
			FROM technologies
				JOIN technology_stage ON technology_stage.technology_id= technologies.id
				JOIN stages ON stages.id = technology_stage.stage_id
				JOIN users  ON  users.id = stages.student_id
				JOIN cities ON cities.id = stages.city_id
				JOIN entreprises ON entreprises.id = stages.entreprise_id
			WHERE technologies.id = ?
		');
		$q->execute([$id]);
		return $q->fetchAll();
	}
	function create()
	{
		$q = $this->db->prepare('INSERT INTO technologies (nom) VALUES(?)');
		return $q->execute([$_GET['nom']]);
	}
	function destroy($id)
	{
		$q = $this->db->prepare('DELETE FROM technologies WHERE id = ? LIMIT 1');
		return $q->execute([$id]);
	}
	function update($params)
	{
		$q = $this->db->prepare('
			UPDATE technologies SET nom = ? WHERE id = ? LIMIT 1
		');
		return $q->execute([$params['nom'], $params['id']]);
	}
};
