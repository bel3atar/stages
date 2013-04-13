<?
class Stages extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('stage');
		$this->model = new StageModel();
	}
	function add()
	{
		$this->view->title = 'Nouveau stage';
		$this->view->entreprises = $this->model->entreprises();
		$this->view->villes      = $this->model->cities();
		$this->view->etudiants   = $this->model->users();
		$this->view->render('stages/new');
	}
	function index()
	{
		$this->view->title = 'Liste des stages';
		$this->view->list  = $this->model->find_all();
		$this->view->render('stages/index');
	}
};
	
