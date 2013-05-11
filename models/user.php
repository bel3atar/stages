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
				users.nom AS unom,
				users.prenom AS uprenom,
				COUNT(stages.id) AS stages,
				email,
				is_admin,
				options.nom AS opt,
				options.id AS optid
			FROM users 
				LEFT JOIN stages  ON stages.student_id = users.id
				LEFT JOIN options ON users.option_id   = options.id
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
			SELECT CONCAT_WS(\' \', nom, prenom) FROM users WHERE id = ? LIMIT 1
		');
		$q->execute([$id]);
		return $q->fetchColumn();
	}
	function findAll($page)
	{
		$q = $this->db->prepare('
			SELECT 
				users.id,
				CONCAT_WS(\' \', users.nom, prenom) AS nom,
				email,
				options.nom AS opt,
				options.id AS optid,
				COUNT(stages.id) AS stages
			FROM users
				JOIN options ON options.id = users.option_id
				LEFT JOIN stages  ON stages.student_id = users.id
			WHERE users.is_admin IS NULL
			GROUP BY users.id
			LIMIT ?, ?
		');
		$q->execute([($page - 1) * PAGE_SIZE, PAGE_SIZE]);
		return $q->fetchAll();
	}
	function stages($id, $page)
	{
		$q = $this->db->prepare('
			SELECT
				entreprises.id AS eid,
				entreprises.nom AS e,
				stages.date AS date,
				stages.id AS id,
				stages.duree * 15 AS duree,
				GROUP_CONCAT(technologies.id SEPARATOR \',\') AS techids,
				GROUP_CONCAT(technologies.nom SEPARATOR \',\') AS techs
			FROM stages
				LEFT JOIN entreprises ON entreprises.id = stages.entreprise_id
				LEFT JOIN technology_stage ON technology_stage.stage_id = stages.id
				LEFT JOIN technologies ON technologies.id = technology_stage.technology_id
				LEFT JOIN cities ON cities.id = stages.city_id
			WHERE stages.student_id = ?
			ORDER BY stages.id DESC
			LIMIT ?, ?
		');
		$q->execute([$id, ($page - 1) * PAGE_SIZE, PAGE_SIZE]);
		$ret = $q->fetchAll();
		return $ret[0]['id'] ? $ret : FALSE;
	}  
	function stages_count($id)
	{
		$q = $this->db->prepare('
			SELECT COUNT(stages.id) FROM stages
			JOIN users ON stages.student_id = users.id
			WHERE users.id = ?
		');
		$q->execute([$id]);
		return $q->fetchColumn();
	}
	function create($params)
	{
		extract($params);
		$q = $this->db->prepare('
			INSERT INTO users (nom, prenom, email, pass, option_id)
			           VALUES (UPPER(:n), :pn, :email, SHA1(:pass), :optn)
		');
		return $q->execute([
			':pass'  => $password,
			':optn'  => $option,
			':pn'    => ucfirst($prenom),
			':email' => $email,
			':n'     => $nom,
		]);
	}
	function count()
	{
		return $this->db->query('
			SELECT COUNT(id) FROM users WHERE is_admin IS NULL
		')->fetchColumn();
	}
	function destroy($id)
	{
		$q = $this->db->prepare('DELETE FROM users WHERE id = ? LIMIT 1');
		return $q->execute([$id]);
	}
	function update($params)
	{
		extract($params);
		$sql = '
			UPDATE users SET
				nom = UPPER(:n),
				prenom = :pn,
				email = :mail,
				option_id = :opt ';
		$p = [
			':n'    => $nom, 
			':pn'    => ucfirst($prenom),
			':mail' => $email,
			':id'   => $id,
			':opt'  => $option
		];
		if (!empty($password) and strlen($password) >= 4) {
			$sql .= ', pass = SHA1(:pwd) ';
			$p[':pwd'] = $password;
		}
		$sql .= 'WHERE id = :id LIMIT 1';
		$q = $this->db->prepare($sql);
		return $q->execute($p);
	}
};
