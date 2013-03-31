<?
class StageModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function findAll($page = 0)
	{
		return $this->db->query('
			SELECT 
				entreprises.nom as entreprise, 
				stages.date as date, 
				stages.duree as duree, 
				cities.nom as ville, 
				countries.nom as pays 
			FROM stages 
				JOIN cities ON cities.id = stages.city_id 
				JOIN people ON  people.id = stages.proposer_id 
				JOIN entreprises ON entreprises.id = people.entreprise_id 
				JOIN countries ON cities.country_id = countries.id
		');
	}
};	

