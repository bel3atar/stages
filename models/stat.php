<? class StatModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find_all()
	{
		return $this->db->query('
			SELECT
				nom,
				(SELECT COUNT(1) FROM technology_stage WHERE technology_id = t.id) AS c
			FROM technologies t');
	}
};
