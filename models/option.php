<? class OptionModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function exists($id)
	{
		$q = $this->db->prepare('
			SELECT EXISTS(SELECT 1 FROM options WHERE id = ? LIMIT 1)
		');
		$q->execute([$id]);
		return $q->fetchColumn();
	}
	function find_all()
	{
		return $this->db->query('
			SELECT 
				options.id, options.nom, COUNT(users.id) AS etudiants
			FROM options
				LEFT JOIN users ON users.option_id = options.id
			WHERE users.is_admin IS NULL
			GROUP BY options.id
		');
	}
	function create()
	{
		$q = $this->db->prepare('
			INSERT INTO options VALUES(NULL, ?);
		');
		return $q->execute([strip_tags($_GET['nom'])]);
	}
	function name($id)
	{
		$q = $this->db->prepare('SELECT nom FROM options WHERE id = ? LIMIT 1');
		$q->execute([$id]);
		return $q->fetch()['nom'];
	}
	function find($id)
	{
		$q = $this->db->prepare('
			SELECT
				users.id,
				CONCAT_WS(\' \', nom, prenom) AS nom,
				ne_le AS ne_le,
				tel,
				email,
				COUNT(stages.id) AS stagecount
			FROM users
				LEFT JOIN stages ON stages.student_id = users.id
			WHERE users.option_id = ? AND is_admin IS NULL
		');
		$q->execute([$id]);
		return $q->fetchAll();
	}
	function update($params)
	{
		$q = $this->db->prepare('UPDATE options SET nom = ? WHERE id = ? LIMIT 1');
		return $q->execute(array_map('strip_tags', [$params['nom'], $params['id']]));
	}
	function delete($id)
	{
		$q = $this->db->prepare('DELETE FROM options WHERE id = ? LIMIT 1');
		return $q->execute([$id]);
	}
};

