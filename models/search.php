<? class SearchModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find($params)
	{
		$ville = $this->db->quote($params['city']);
		$sql = "
			SELECT
				DISTINCT stages.id,
				stages.city_id,
				stages.date,
				stages.duree * 15 AS duree,
				cities.nom,
				stages.description
			FROM stages
				JOIN cities           ON stages.city_id = cities.id
				JOIN technology_stage ON technology_stage.stage_id = stages.id
				JOIN technologies     ON technology_stage.technology_id = technologies.id
			WHERE cities.id LIKE $ville 
		";
		if ($params['formTags']) {
			$sql .= 'AND technologies.nom IN (';
			$tags = explode(',', $params['formTags']);
			$i = 0; 
			$len = sizeof($tags);
			foreach ($tags as $t) {
				$t = $this->db->quote($t);
				$sql .= $t;
				if ($i++ != $len - 1) $sql .= ', ';
			}
			$sql .= ')';
		} 
		return $this->db->query($sql);
	}
	function technologies()
	{
		return $this->db->query('
			SELECT nom FROM technologies
			JOIN technology_stage ON technology_stage.technology_id = technologies.id
			JOIN stages ON stages.id = technology_stage.stage_id
			GROUP BY technologies.id
			HAVING COUNT(stages.id) != 0
		')->fetchAll();
	}
	function cities()
	{
		return $this->db->query('
			SELECT cities.id, nom FROM cities 
			JOIN stages ON stages.city_id = cities.id
			GROUP BY cities.id
			HAVING COUNT(stages.id) != 0
			ORDER BY nom
			');
	}
};
