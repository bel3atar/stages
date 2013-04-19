<?
class Stages extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('stage');
		$this->model = new StageModel();
		$this->view->controller = 'stages';
	}
	function add()
	{
		$this->view->title = 'Nouveau stage';
		$this->view->entreprises  = $this->model->entreprises();
		$this->view->technologies = $this->model->technologies();
		$this->view->users        = $this->model->users();
		$this->view->people       = $this->model->people();
		$this->view->cities       = $this->model->cities();
		$this->view->render('stages/new', FALSE, FALSE);
	}
	function index()
	{
		$this->view->title = 'Liste des stages';
		$this->view->list  = $this->model->find_all();
		$this->view->render('stages/index');
	}
	function create()
	{
		$this->model->create($_GET);
		header('Location: /stages');
	}
	function destroy($id)
	{
		$this->model->destroy($id);
		header('Location: /stages');
	}
	function edit($id)
	{
		$this->view->title = 'Modifier un stage';
		$this->view->stage = $this->model->find($id);
		$this->view->entreprises  = $this->model->entreprises();
		$this->view->technologies = $this->model->technologies();
		$this->view->users        = $this->model->users();
		$this->view->people       = $this->model->people();
		$this->view->cities       = $this->model->cities();
		$this->view->render('stages/edit', FALSE, FALSE);
	}
	function update()
	{
		$this->model->update($_GET);
		header('Location: /stages');
	}
};
	
