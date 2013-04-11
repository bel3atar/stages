<?
class UserModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function full_name($id)
	{
		$q = $this->db->prepare('
			SELECT nom, prenom FROM users WHERE id = ? LIMIT 1
		');
		$q->execute([$id]);
		$q = $q->fetch();
		return "{$q['nom']} {$q['prenom']}";
	}
	function findAll()
	{
		return $this->db->query('
			SELECT 
				users.id,
				CONCAT_WS(\' \', users.nom, prenom) AS nom,
				email,
				tel,
				ne_le,
				options.nom AS opt,
				options.id AS optid,
				COUNT(stages.id) AS stages
			FROM users
				JOIN options ON options.id = users.option_id
				JOIN stages  ON stages.student_id = users.id
			GROUP BY users.id
		');
	}
	function stages($id)
	{
		$q = $this->db->prepare('
			SELECT
				entreprises.id AS eid,
				entreprises.nom AS e,
				stages.date AS date,
				stages.duree * 15 AS duree,
				GROUP_CONCAT(technologies.id SEPARATOR \',\') AS techids,
				GROUP_CONCAT(technologies.nom SEPARATOR \',\') AS techs
			FROM stages
				JOIN branches ON branches.id = stages.branch_id
				JOIN entreprises ON entreprises.id = branches.entreprise_id
				JOIN technology_stage ON technology_stage.stage_id = stages.id
				JOIN technologies ON technologies.id = technology_stage.technology_id
				JOIN cities ON cities.id = branches.city_id
			WHERE stages.student_id = ?
			GROUP BY stages.id
		');
		$q->execute([$id]);
		return $q->fetchAll();
	}
	function last_id()
	{
		return $this->db->query('SELECT MAX(id) AS id FROM users')->fetch()['id'];
	}
};
