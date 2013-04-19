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
			GROUP BY options.id
		');
	}
	function create()
	{
		return $this->db->query("
			INSERT INTO options VALUES(NULL, '{$_GET['nom']}');
		");
	}
	function name($id)
	{
		return $this->db->query("
			SELECT nom FROM options WHERE id = $id
		")->fetch()['nom'];
	}
	function find($id)
	{
		$q = $this->db->prepare('
			SELECT
				id,
				CONCAT_WS(\' \', nom, prenom) AS nom,
				ne_le AS ne_le,
				tel,
				email
			FROM users
			WHERE users.option_id = ?
		');
		$q->execute([$id]);
		return $q->fetch();
	}
	function update($params)
	{
		$q = $this->db->prepare('UPDATE options SET nom = ? WHERE id = ? LIMIT 1');
		return $q->execute([$params['nom'], $params['id']]);
	}
	function delete($id)
	{
		$q = $this->db->prepare('DELETE FROM options WHERE id = ? LIMIT 1');
		return $q->execute([$id]);
	}
};

