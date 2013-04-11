<? class OptionModel extends Model {
	function __construct()
	{
		parent::__construct();
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
		return $this->db->query("
			SELECT
				id,
				CONCAT_WS(' ', nom, prenom) AS nom,
				ne_le,
				tel,
				email
			FROM users
			WHERE users.option_id = $id
		");
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

