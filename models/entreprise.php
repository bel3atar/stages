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
	function find_all($page)
	{
		$q =$this->db->prepare('
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
			ORDER BY entreprises.nom
			LIMIT ?, ?
		');
		$q->execute([($page - 1) * PAGE_SIZE, PAGE_SIZE]);
		return $q->fetchAll();
	}
	function find($id)
	{
		$q = $this->db->prepare('
			SELECT
				entreprises.id, 
				entreprises.nom, 
				site, 
				COUNT(people.id) AS responsables, 
				COUNT(stages.id) AS stages
			FROM entreprises 
				LEFT JOIN stages ON entreprises.id = stages.entreprise_id
				LEFT JOIN people ON entreprises.id = people.entreprise_id
			WHERE entreprises.id = ? LIMIT 1
		');
		$q->execute([$id]);
		return $q->fetch();
	}
	function count()
	{
		return $this->db->query('SELECT COUNT(id) FROM entreprises')->fetchColumn();
	}
	function create($params)
	{
		$q = $this->db->prepare('
			INSERT INTO entreprises (nom, site) VALUES (:nom, :site)
		');
		return $q->execute([
			':nom'  => strip_tags($params['nom']),
			//':logo' => strip_tags($params['logo']),
			':site' => strip_tags($params['site'])
		]);
	}
	function destroy($id)
	{
		$q = $this->db->prepare('DELETE FROM entreprises WHERE id = ?');
		return $q->execute([$id]);
	}
	function people($id, $page)
	{
		$q = $this->db->prepare('
			SELECT
				people.id AS id,
				CONCAT_WS(\' \', people.nom, people.prenom) AS nom,
				people.email AS email
			FROM people
				JOIN entreprises ON people.entreprise_id = entreprises.id
			WHERE entreprises.id = ?
			LIMIT ?, ?
		');
		$q->execute([$id, ($page - 1) * PAGE_SIZE, PAGE_SIZE]);
		return $q->fetchAll();
	}
	function people_count($id)
	{
		$q = $this->db->prepare('
			SELECT COUNT(people.id)
			FROM people JOIN entreprises ON people.entreprise_id = entreprises.id
			WHERE entreprises.id = ?
		');
		$q->execute([$id]);
		return $q->fetchColumn();
	}
	function stages($id, $page)
	{
		$q = $this->db->prepare('
			SELECT
				stages.id AS stid,
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
			ORDER BY stages.id DESC
			LIMIT ?, ?
		');
		$q->execute([$id, ($page - 1) * PAGE_SIZE, PAGE_SIZE]);
		return $q->fetchAll();
	}
	function stages_count($id)
	{
		$q = $this->db->prepare('
			SELECT COUNT(stages.id)
			FROM stages
				JOIN entreprises ON entreprises.id = stages.entreprise_id
			WHERE entreprises.id = ?
		');
		$q->execute([$id]);
		return $q->fetchColumn();
	}
	function update($params)
	{
		extract($params);
		$q = $this->db->prepare('
			UPDATE
				entreprises
			SET
				nom = :nom,
				site = :site
			WHERE id = :id
			LIMIT 1
		');
		return $q->execute([
			':id'   => $id,
			':nom'  => strip_tags($nom),
			':site' => strip_tags($site),
		]);	
	}
};
