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
			SELECT
				id, CONCAT_WS(\' \', nom, prenom) AS nom
			FROM users
			WHERE is_admin IS NULL
		');
	}
	function people()
	{
		return $this->db->query('
			SELECT id, CONCAT_WS(\' \', nom, prenom) AS nom FROM people
		')->fetchAll();
	}
	function find_all($page)
	{
		$q = $this->db->prepare('
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
			WHERE users.is_admin IS NULL
			GROUP BY stages.id
			ORDER BY stages.id DESC
			LIMIT ?, ?
		');
		$q->execute([($page - 1) * PAGE_SIZE, PAGE_SIZE]);
		return $q->fetchAll();
	}
	function create($params)
	{
		extract($params);
		try {
			$this->db->beginTransaction();
			$q = $this->db->prepare('
				INSERT INTO stages 
					(description, date, duree, entreprise_id, proposer_id, supervisor_id,
					student_id, city_id)
				VALUES 
					(:desc, :date, :duree, :ent, :pro, :sup, :stdnt, :ctid)
			');
			$q->execute([
				':stdnt' => Session::get('is_admin') ? $user : Session::get('id'),
				':sup'   => empty($supervisor) ? NULL : $supervisor,
				':ent'   => $entreprise,
				':duree' => $duree / 15,
				':desc'  => $description,
				':pro'   => $proposer,
				':ctid'  => $ville,
				':date'  => $date
			]);
			$id = $this->db->lastInsertId();
			require_once 'models/technology.php';
			$t = new TechnologyModel();
			$q = $this->db->prepare('
				INSERT INTO technology_stage (technology_id, stage_id) 
				VALUES ((SELECT id FROM technologies WHERE nom = ? LIMIT 1), ?)
			');
			foreach (split(',', $formTags) as $tag)
				$q->execute([$tag, $id]);
			return $this->db->commit();
		} catch (PDOException $e) {
			$this->db->rollBack();
			return FALSE;
		}
	}
	function destroy($id)
	{
		try {
			$this->db->beginTransaction();
			$q = $this->db->prepare('DELETE FROM technology_stage WHERE stage_id = ?');
			$q->execute([$id]);
			$q = $this->db->prepare('DELETE FROM stages WHERE id = ? LIMIT 1');
			$q->execute([$id]);
			return $this->db->commit();
		} catch (PDOException $e) {
			$this->db->rollBack();
			return FALSE;
		}
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
				cities.nom AS ville,
				description,
				entreprises.nom AS e,
				GROUP_CONCAT(technologies.id SEPARATOR \',\') AS tids,
				GROUP_CONCAT(technologies.nom SEPARATOR \',\') AS ts,
				CONCAT_WS(\' \', users.nom, users.prenom) AS u,
				(
					SELECT CONCAT_WS(\' \', nom, prenom) 
					FROM people 
					WHERE id = stages.proposer_id
				) AS p,
				(SELECT email FROM people WHERE id = stages.proposer_id) AS pemail,
				(
					SELECT CONCAT_WS(\' \', nom, prenom)
					FROM people
					WHERE id = stages.supervisor_id
				) AS s,
				(SELECT email FROM people WHERE id = stages.supervisor_id) AS semail,
				stages.description AS description
			FROM stages
				JOIN technology_stage ON technology_stage.stage_id = stages.id
				JOIN technologies ON technology_stage.technology_id = technologies.id
				JOIN users ON users.id = stages.student_id
				JOIN entreprises ON entreprises.id = stages.entreprise_id
				JOIN cities ON cities.id = stages.city_id
			WHERE stages.id = ?
			LIMIT 1
		');
		$q->execute([$id]);
		return $q->fetch();
	}
	function update($params)
	{
		extract($params);
		try {
			$this->db->beginTransaction();
			$q = $this->db->prepare('
				UPDATE stages SET
					entreprise_id = :eid,
					city_id = :ctid,
					date = :date,
					duree = :duree,
					student_id = :uid,
					proposer_id = :pid,
					supervisor_id = :sid,
					description = :desc
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
				':desc'  => $description,
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
			return $this->db->commit();
		} catch (PDOException $e) {
			$this->db->rollBack();
			return FALSE;
		}
	}
	function count()
	{
		return $this->db->query('SELECT COUNT(id) FROM stages')->fetchColumn();
	}
	function lastID()
	{
		return $this->db->query('SELECT MAX(id) FROM stages LIMIT 1')->fetchColumn();
	}
};
