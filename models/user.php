<?
class UserModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find($id)
	{
	}
	function findAll()
	{
		return $this->db->query('
			SELECT 
				users.id,
				users.nom as nom,
				prenom,
				email,
				tel,
				sex,
				ne_le,
				options.nom as opt,
				COUNT(stages.id) AS stages
			FROM users
				JOIN options ON options.id = users.option_id
				JOIN stages  ON stages.student_id = users.id
			GROUP BY users.id
		');
	}
};
