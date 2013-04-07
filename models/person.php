<? class PersonModel extends Model {
	function __construct()
	{
		parent::__construct();
	}	
	function find_all()
	{
		return $this->db->query('
			SELECT
				people.nom,
				prenom,
				email,
				entreprises.nom as entreprise,
				entreprises.id as eid,
				COUNT(stages.proposer_id) as propositions,
				COUNT(stages.supervisor_id) as supervisions
			FROM people
				JOIN entreprises on entreprises.id = people.entreprise_id
				JOIN stages on stages.proposer_id = people.id
			GROUP BY stages.proposer_id, stages.supervisor_id
		');
	}
};
