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
				stages.id AS id,
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
	function destroy($id)
	{
		$q = $this->db->prepare('DELETE FROM stages WHERE id = ? LIMIT 1');
		return $q->execute([$id]);
	}
	function exists($id)
	{
		$q = $this->db->prepare('
			SELECT EXISTS(SELECT 1 FROM stages WHERE id = ? LIMIT 1)
		');
		$q->execute([$id]);
		return $q->fetchColumn();
	}
	function find($id)
	{
		$q = $this->db->prepare('
			SELECT
				stages.id AS id,
				stages.date AS date,
				stages.duree * 15 AS duree,
				stages.student_id AS uid,
				stages.proposer_id AS pid,
				stages.supervisor_id AS sid,
				stages.city_id AS ctid,
				stages.entreprise_id AS eid,
				GROUP_CONCAT(technologies.id SEPARATOR \',\') AS tids,
				GROUP_CONCAT(technologies.nom SEPARATOR \',\') AS ts
			FROM stages
				JOIN technology_stage ON technology_stage.stage_id = stages.id
				JOIN technologies ON technology_stage.technology_id = technologies.id
			WHERE stages.id = ?
			LIMIT 1
		');
		$q->execute([$id]);
		return $q->fetch();
	}
	function update($params)
	{
		extract($params);
		//print_r($formTags);
		//exit;
		$this->db->beginTransaction();
		$q = $this->db->prepare('
			UPDATE stages SET
				entreprise_id = :eid,
				city_id = :ctid,
				date = :date,
				duree = :duree,
				student_id = :uid,
				proposer_id = :pid,
				supervisor_id = :sid
			WHERE id = :id
			LIMIT 1
		');
		$q->execute([
			':eid'   => $entreprise,
			':ctid'  => $ville,
			':date'  => $date,
			':duree' => $duree / 15,
			':uid'   => $user,
			':pid'   => $proposer,
			':sid'   => $supervisor,
			':id'    => $id
		]);
		$q = $this->db->prepare('DELETE FROM technology_stage WHERE stage_id = ?');
		$q->execute([$id]);
		$q = $this->db->prepare('
			INSERT INTO technology_stage (stage_id, technology_id)
			VALUES (?, (SELECT id FROM technologies WHERE nom = ?))
		');
		foreach (split(',', $formTags) as $t)
			$q->execute([$id, $t]);
		$this->db->commit();
	}
};	

