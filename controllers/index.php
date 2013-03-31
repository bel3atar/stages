<?
class Index extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('stage');
		$this->model = new StageModel();
		$this->view->list = $this->model->findAll();
		$this->view->title = 'Derniers stages';
		$this->view->render('index');
	}
};
