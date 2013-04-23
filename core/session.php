<? class Session {
	static function get($k)
	{
		return isset($_SESSION[$k]) ? $_SESSION[$k] : null;
	}
};
