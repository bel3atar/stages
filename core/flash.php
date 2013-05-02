<? class Flash {
	static function info($msg)
	{
		$_SESSION['notice']['info'] = $msg;
	}
	static function error($msg)
	{
		$_SESSION['notice']['error'] = $msg;
	}
	static function success($msg)
	{
		$_SESSION['notice']['success'] = $msg;
	}
};
