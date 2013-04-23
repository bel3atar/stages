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
		$this->view->title        = 'Nouveau stage';
		$this->view->entreprises  = $this->model->entreprises();
		$this->view->technologies = $this->model->technologies();
		$this->view->users        = $this->model->users();
		$this->view->people       = $this->model->people();
		$this->view->cities       = $this->model->cities();
		$this->view->stylesheets  = ['tagmanager/bootstrap-tagmanager'];
		$this->view->scripts      = [
			' src="' . URL . 'assets/tagmanager/bootstrap-tagmanager.js"',
			'>jQuery(".tagManager").tagsManager();'
		];
		$this->view->render('stages/new', FALSE);
	}
	function index()
	{
		$this->view->title = 'Liste des stages';
		$this->view->list  = $this->model->find_all();
		$this->view->render('stages/index');
	}
	function create()
	{
		if (Session::get('logged'))
			$this->model->create($_GET);
		header('Location: /stages');
	}
	function destroy($id)
	{
		if (Session::get('is_admin'))
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
		$this->view->stylesheets  = ['tagmanager/bootstrap-tagmanager'];
		$this->view->scripts      = [
			'src="' . URL . 'assets/tagmanager/bootstrap-tagmanager.js"',
			'jQuery(".tagManager").tagsManager();'
		];
		$this->view->render('stages/edit', FALSE);
	}
	function update()
	{
		if (Session::get('is_admin'))
			$this->model->update($_GET);
		header('Location: /stages');
	}
};
	
