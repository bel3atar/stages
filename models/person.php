<? class PersonModel extends Model {
	function __construct()
	{
		parent::__construct();
	}	
	function find_all($page)
	{
		$q = $this->db->prepare('
			SELECT
				people.id AS id,
				CONCAT_WS(\' \', people.nom, prenom) AS nom,
				email,
				entreprises.nom AS entreprise,
				entreprises.id AS eid,
				COUNT(stages.proposer_id) as propositions,
				COUNT(stages.supervisor_id) as supervisions
			FROM people
				LEFT JOIN entreprises on entreprises.id = people.entreprise_id
				LEFT JOIN stages on stages.proposer_id = people.id
			GROUP BY people.id
			ORDER BY nom
			LIMIT ?, ?
		');
		$q->execute([($page - 1) * PAGE_SIZE, PAGE_SIZE]);
		return $q->fetchAll();
	}
	function count()
	{
		return $this->db->query('SELECT COUNT(id) FROM people')->fetchColumn();
	}
	function exists($id)
	{
		$q = $this->db->prepare('
			SELECT EXISTS(SELECT 1 FROM people WHERE id = ? LIMIT 1)
		');
		$q->execute([$id]);
		return $q->fetchColumn();
	}
	function find($id)
	{
		$q = $this->db->prepare('
			SELECT id, nom, prenom, email, entreprise_id AS eid
			FROM people
			WHERE id = ?
			LIMIT 1
		');
		$q->execute([$id]);
		return $q->fetch();
	}
	function destroy($id)
	{
		$q = $this->db->prepare('DELETE FROM people WHERE id = ? LIMIT 1');
		return $q->execute([$id]);
	}
	function update($params)
	{
		extract($params);
		$q = $this->db->prepare('
			UPDATE people SET
				nom = :nom,
				prenom = :prenom,
				email = :email,
				entreprise_id = :eid
			WHERE id = :id
			LIMIT 1
		');
		return $q->execute([
			':eid'    => strip_tags($entreprise),
			':prenom' => strip_tags($prenom),
			':email'  => strip_tags($email),
			':nom'    => strip_tags($nom),
			':id'     => $id
		]);
	}
	function create($params)
	{
		extract($params);
		$q = $this->db->prepare('
			INSERT INTO people
				(nom, prenom, email, entreprise_id)
				VALUES(:nom, :prenom, :email, :eid)
		');
		return $q->execute([
			':nom'    => strip_tags($nom),
			':email'  => strip_tags($email),
			':prenom' => strip_tags($prenom),
			':eid'    => $entreprise
		]);
	}
};
