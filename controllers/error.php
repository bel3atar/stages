<?
class Error extends Controller {
	function __construct($addr)
	{
		parent::__construct();
		$this->view->title = 'Page introuvable';
		$this->view->addr = $addr;
		$this->view->render('error', true);
	}
};
