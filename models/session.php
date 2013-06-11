<? class SessionModel extends Model {
	function __construct()
	{
		parent::__construct();
	}
	function find($login, $pass)
	{
		$q = $this->db->prepare('
			SELECT 
				id, is_admin, CONCAT_WS(\' \', nom, prenom) AS nom, pass
			FROM users
			WHERE email = ?
			LIMIT 1
		');
		$q->execute([$login]);
		$row = $q->fetch();
		require 'core/password.php';
		if ($q->rowCount() and password_verify($pass, $row['pass']))
			return $row;
		else
			return FALSE;
	}
};
