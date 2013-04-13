<?
class EntrepriseModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find_all()
	{
		return $this->db->query('
			SELECT
				entreprises.id AS id,
				entreprises.nom,
				COUNT(cities.id) AS villes,
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
			SELECT nom, site, logo FROM entreprises WHERE entreprises.id = ? LIMIT 1
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
			':nom'  => $params['nom'],
			':logo' => $params['logo'],
			':site' => $params['site']
		]);
		$q = $this->db->prepare('
				INSERT INTO branches (entreprise_id, city_id, adr, tel)
				VALUES (:e, :ct, :adr, :tel)
		');
		$q->execute([
			':e'   => $this->db->lastInsertId(),
			':ct'  => $params['ville'],
			':adr' => $params['adr'],
			':tel' => $params['tel']
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
};
