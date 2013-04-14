<?
class Controller {
	protected $model;
	protected $view;
	function __construct()
	{
		$this->view = new View();
	}
	function require_model($n)
	{
		require_once "models/{$n}.php";
	}
};
