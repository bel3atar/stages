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
};

