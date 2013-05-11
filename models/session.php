<? class SessionModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find($login, $pass)
	{
		$q = $this->db->prepare('
			SELECT id, is_admin, CONCAT_WS(\' \', nom, prenom) AS nom
			FROM users
			WHERE email = ? AND pass = SHA1(?)
			LIMIT 1
		');
		$q->execute([$login, $pass]);
		return $q->fetch();
	}
};
