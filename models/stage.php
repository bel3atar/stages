<?
class StageModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function cities()
	{
		return $this->db->query('SELECT id, nom FROM cities');
	}
	function entreprises()
	{
		return $this->db->query('SELECT id, nom FROM entreprises');
	}
	function technologies()
	{
		return $this->db->query('SELECT id, nom FROM technologies')->fetchAll();
	}
	function users()
	{
		return $this->db->query('
			SELECT id, CONCAT_WS(\' \', nom, prenom) AS nom FROM users
		');
	}
	function people()
	{
		return $this->db->query('
			SELECT id, CONCAT_WS(\' \', nom, prenom) AS nom FROM people
		')->fetchAll();
	}
	function find_all()
	{
		return $this->db->query('
			SELECT
				GROUP_CONCAT(technologies.id  SEPARATOR \',\') AS techids,
				GROUP_CONCAT(technologies.nom SEPARATOR \',\') AS techs,
				CONCAT_WS(\' \', users.nom, users.prenom) AS nom,
				entreprises.nom AS entreprise,
				stages.duree * 15 AS duree,
				entreprises.id AS eid,
				cities.id AS idville,
				stages.date AS date,
				cities.nom AS ville,
				users.id AS uid
			FROM stages
				     JOIN cities        ON    stages.city_id     =             cities.id
				     JOIN users          ON   stages.student_id     =           users.id
				     JOIN entreprises     ON  stages.entreprise_id     =  entreprises.id
				LEFT JOIN technology_stage ON technology_stage.stage_id   =    stages.id
				LEFT JOIN technologies ON technology_stage.technology_id=technologies.id
			GROUP BY stages.id
			ORDER BY stages.date DESC
		');
	}
	function create($params)
	{
		try {
			$this->db->beginTransaction();
			$q = $this->db->prepare('
				INSERT INTO stages 
					VALUES (NULL, :date, :duree, :ent, :pro, :sup, :stdnt, :ctid)
			');
			extract($params);
			$q->execute([
				':sup'   => $supervisor,
				':ent'   => $entreprise,
				':pro'   => $proposer,
				':duree' => $duree / 15,
				':ctid'  => $ville,
				':date'  => $date,
				':stdnt' => $user
			]);
			$id = $this->db->lastInsertId();
			require_once 'models/technology.php';
			$t = new TechnologyModel();
			$q = $this->db->prepare('
				INSERT INTO technology_stage (technology_id, stage_id) VALUES (?, ?)
			');
			foreach (split(',', $formTags) as $tag)
				$q->execute([$t->find_id($tag), $id]);
			$this->db->commit();
		} catch (PDOException $e) {
			$this->db->rollback();
		}
	}
};	

