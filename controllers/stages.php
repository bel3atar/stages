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
		$this->view->render('stages/new', FALSE);
	}
	function index()
	{
		$this->view->title = 'Liste des stages';
		$this->view->list  = $this->model->find_all($this->page());
		$this->view->render('stages/index');
	}
	function create()
	{
		if (Session::get('logged'))
			if ($this->model->create($_GET))
				Flash::success('Stage enregistré.');
			else
				Flash::error('Création du stage non effectuée.');
		header('Location: ' . URL . 'stages');
	}
	function destroy($id)
	{
		if (Session::get('is_admin'))
			if ($this->model->destroy($id))
				Flash::success('Le stage a bien été supprimé.');
			else
				Flash::error('La suppression du stage n\'a pas abouti.');
		header('Location: ' . URL . 'stages');
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
		$this->view->render('stages/edit', FALSE);
	}
	function update()
	{
		if (Session::get('is_admin'))
			if ($this->model->update($_GET))
				Flash::success('Stage mis à jour avec succès');
			else
				Flass::error('La mise à jour n\'a pas été effectuée.');
		header('Location: ' . URL . 'stages');
	}
	function _count() { return $this->model->count(); }
};
