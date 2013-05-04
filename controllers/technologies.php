<?
class Technologies extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('technology');
		$this->model = new TechnologyModel();
		$this->view->controller = 'technologies';
	}
	function index()
	{
		$this->view->title = 'Liste des technologies';
		$this->view->list  = $this->model->find_all($this->page());
		$this->view->render('technologies/index');
	}
	function stages($id)
	{
		$this->view->list = $this->model->stages($id);
		$this->view->title = $this->model->find_name($id, $this->page());
		$this->view->render('technologies/stages');
	}
	function add()
	{
		$this->view->title = 'Nouvelle technologie';
		$this->view->render('technologies/new');
	}
	function create()
	{
		if (Session::get('logged')) {
			if ($this->model->create())
				Flash::success('La technologie a bien été ajoutée.');
			else
				Flash::error('La technologie n\'a pas été ajoutée.');
			header('Location: ' . URL . 'technologies');
		} else
			$this->unauthorised();
	}
	function edit($id)
	{
		$this->view->id  = $id;
		$this->view->nom = $this->model->find_name($id);
		$this->view->render('technologies/edit');
	}
	function update()
	{
		if (Session::get('is_admin')) {
			if ($this->model->update($_GET))
				Flash::success('La mise à jour a bien été effectuée.');
			else
				Flash::error('La mise à jour n\'a pas été effectuée.');
			header('Location: ' . URL . 'technologies');
		} else
			$this->unauthorised();
	}
	function destroy($id)
	{
		if (Session::get('is_admin')) {
			if ($this->model->destroy($id))
				Flash::success('La technologie a bien été supprimée.');
			else
				Flash::error('La technologie n\'a pas été supprimée.');
			header('Location: ' . URL . 'technologies');
		} else
			$this->unauthorised();
	}
	function _count() { return $this->model->count(); }
	function stages_count($id) { return $this->model->stages_count($id); }
};
?>
