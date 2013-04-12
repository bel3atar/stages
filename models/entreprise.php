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
				entreprises.id AS eid, entreprises.nom,
				COUNT(branches.id) AS branches,
				(
					SELECT COUNT(*) 
					FROM stages 
						JOIN branches ON stages.branch_id = branches.id
						JOIN entreprises ON branches.entreprise_id = entreprises.id
					WHERE entreprises.id = eid AND stages.branch_id = branches.id
				) AS stages,
				COUNT(DISTINCT branches.city_id) as villes
			FROM entreprises
				JOIN branches ON branches.entreprise_id = entreprises.id
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
};
