<?
class Controller {
	public $model;
	protected $view;
	function __construct()
	{
		$this->view = new View();
	}
	function require_model($n)
	{
		require_once "models/{$n}.php";
	}
	function page()
	{
		$caller = debug_backtrace()[1];
		$caller_function = $caller['function'];
		$caller_function = $caller_function === 'index' ? '' : $caller_function;
		$count_function = "{$caller_function}_count";
		$caller_arg = empty($caller['args'][0]) ? NULL : $caller['args'][0];
		$count = $caller['object']->$count_function($caller_arg);
		$_GET['page_max'] = ceil($count / PAGE_SIZE);
		if (empty($_GET['page']))
			$_GET['page'] = 1;
		else {
			if ($_GET['page'] < 1)
				$_GET['page'] = 1;
			else if ($_GET['page'] > $_GET['page_max'])
				$_GET['page'] = $_GET['page_max'];
		}
		return $_GET['page'];
	}
	function unauthorised()
	{
		Flash::error('Cette opération ne vous est pas autorisée. Identifiez-vous d\'abord!');
		header('Location: ' . URL . 'sessions/new');
	}
};
