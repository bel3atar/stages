<?
class UserModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function exists($id)
	{
		$q = $this->db->prepare('
			SELECT EXISTS(SELECT 1 FROM users WHERE id = ? LIMIT 1)
		');
		$q->execute([$id]);
		return $q->fetchColumn();
	}
	function find($id)
	{
		$q = $this->db->prepare('
			SELECT 
				users.id AS id,
				CONCAT_WS(\' \', users.nom, prenom) AS nom,
				COUNT(stages.id) AS stages,
				email,
				tel,
				is_admin,
				options.nom AS opt,
				options.id AS optid
			FROM users 
				LEFT JOIN stages  ON stages.student_id = users.id
				     JOIN options ON users.option_id   = options.id
			WHERE users.id = ?
			GROUP BY users.id
			LIMIT 1
		');
		$q->execute([$id]);
		return $q->fetch();
	}
	function full_name($id)
	{
		$q = $this->db->prepare('
			SELECT CONCAT_WS(\' \', nom, prenom) AS n FROM users WHERE id = ? LIMIT 1
		');
		$q->execute([$id]);
		return $q = $q->fetch()['n'];
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
				LEFT JOIN stages  ON stages.student_id = users.id
			WHERE users.is_admin IS NULL
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
				LEFT JOIN entreprises ON entreprises.id = stages.entreprise_id
				LEFT JOIN technology_stage ON technology_stage.stage_id = stages.id
				LEFT JOIN technologies ON technologies.id = technology_stage.technology_id
				LEFT JOIN cities ON cities.id = stages.city_id
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
	function create($params)
	{
		$q = $this->db->prepare('
			INSERT INTO users (nom, prenom, email, tel, pass, option_id)
			           VALUES (:n, :pn, :email, :tel, MD5(:pass), :optn)
		');
		extract($params);
		return $q->execute([
			':pass'  => $password,
			':optn'  => $option,
			':pn'    => $prenom,
			':email' => $email,
			':n'     => $nom,
			':tel'   => $tel
		]);
	}
};
