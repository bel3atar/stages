<?
class EntrepriseModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function exists($id)
	{
		$q = $this->db->prepare('
			SELECT EXISTS(SELECT 1 FROM entreprises WHERE id = ? LIMIT 1)
		');
		$q->execute([$id]);
		return $q->fetchColumn();
	}
	function find_all()
	{
		return $this->db->query('
			SELECT
				entreprises.id AS id,
				entreprises.nom,
				COUNT(stages.id) AS stages,
				COUNT(people.id) AS personnel
			FROM entreprises
				LEFT JOIN stages ON stages.entreprise_id = entreprises.id
				LEFT JOIN people ON people.entreprise_id = entreprises.id
				LEFT JOIN cities ON stages.city_id       = cities.id
			GROUP BY entreprises.id
		');
	}
	function find($id)
	{
		$q = $this->db->prepare('
			SELECT id, nom, site, logo FROM entreprises WHERE entreprises.id = ? LIMIT 1
		');
		$q->execute([$id]);
		return $q->fetch();
	}
	function branches($id)
	{
		$q = $this->db->prepare('
			SELECT tel, adr, cities.nom AS ville
			FROM branches
				JOIN cities ON cities.id = branches.city_id
			WHERE entreprise_id = ?
		');
		$q->execute([$id]);
		return $q->fetchAll();
	}
	function create($params)
	{
		$this->db->beginTransaction();
		$q = $this->db->prepare('
			INSERT INTO entreprises (nom, logo, site) VALUES (:nom, :logo, :site)
		');
		$q->execute([
			':nom'  => strip_tags($params['nom']),
			':logo' => strip_tags($params['logo']),
			':site' => strip_tags($params['site'])
		]);
		$q = $this->db->prepare('
				INSERT INTO branches (entreprise_id, city_id, adr, tel)
				VALUES (:e, :ct, :adr, :tel)
		');
		$q->execute([
			':e'   => $this->db->lastInsertId(),
			':ct'  => strip_tags($params['ville']),
			':adr' => strip_tags($params['adr']),
			':tel' => strip_tags($params['tel'])
		]);
		$this->db->commit();
	}
	function destroy($id)
	{
		$q = $this->db->prepare('DELETE FROM entreprises WHERE id = ?');
		return $q->execute([$id]);
	}
	function people($id)
	{
		$q = $this->db->prepare('
			SELECT
				people.id AS id,
				CONCAT_WS(\' \', people.nom, people.prenom) AS nom,
				people.email AS email
			FROM people
				JOIN entreprises ON people.entreprise_id = entreprises.id
			WHERE entreprises.id = ?
		');
		$q->execute([$id]);
		return $q->fetchAll();
	}
	function stages($id)
	{
		$q = $this->db->prepare('
			SELECT
				stages.date AS date,
				stages.duree * 15 AS duree,
				cities.nom AS ville,
				(
					SELECT CONCAT_WS(\' \', nom, prenom)
					FROM people WHERE id = stages.supervisor_id LIMIT 1
				) AS supervisor,
				(
					SELECT CONCAT_WS(\' \', nom, prenom)
					FROM people WHERE id = stages.proposer_id LIMIT 1
				) AS proposer,
				CONCAT_WS(\' \', users.nom, users.prenom) AS student,
				users.id AS uid,
				cities.id AS ctid,
				GROUP_CONCAT(technologies.id SEPARATOR \',\') AS tids,
				GROUP_CONCAT(technologies.nom SEPARATOR \',\') AS ts
			FROM stages
				JOIN cities ON cities.id = stages.city_id
				JOIN users  ON  users.id = stages.student_id
				JOIN technology_stage ON technology_stage.stage_id = stages.id
				JOIN technologies ON technologies.id = technology_stage.technology_id
			WHERE entreprise_id = ?
			GROUP BY stages.id
		');
		$q->execute([$id]);
		return $q->fetchAll();
	}
	function update($params)
	{
		$q = $this->db->prepare('
			UPDATE
				entreprises
			SET
				nom = :nom,
				logo = :logo,
				site = :site
			WHERE id = :id
			LIMIT 1
		');
		extract($params);
		return $q->execute([
			':id'   => $id,
			':nom'  => strip_tags($nom),
			':site' => strip_tags($site),
			':logo' => strip_tags($logo)
		]);	
	}
};
