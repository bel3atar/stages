<? class Options extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('option');
		$this->model = new OptionModel();
		$this->view->controller = 'options';
	}
	function index()
	{
		$this->view->title = 'Liste des options';
		$this->view->list  = $this->model->find_all($this->page());
		$this->view->render('options/index');
	}
	function _count() { return $this->model->count(); }
	function add()
	{
		$this->view->title = 'Nouvelle option';
		$this->view->render('options/new');
	}
	function create()
	{
		if (Session::get('logged')) {
			if ($this->model->create())
				Flash::success('Option ajoutée.');
			else
				Flash::error('L\'option n\'a pas été ajoutée.');
			header('Location: ' . URL . 'options');
		} else
			$this->unauthorised();
	}
	function students($id)
	{
		$this->view->name = $this->model->name($id);
		$this->view->title = "{$this->view->name} | Etudiants";
		$this->view->list  = $this->model->find($id, $this->page());
		$this->view->render('options/students');
	}
	function students_count($id) { return $this->model->students_count($id); }
	function edit($id)
	{
		$this->view->nom   = $this->model->name($id);
		$this->view->id    = $id;
		$this->view->title = "Modifier une option";
		$this->view->render('options/edit');
	}
	function update($id)
	{
		if (Session::get('is_admin')) {
			if ($this->model->update($_GET))
				Flash::success('Option mise à jour.');
			header('Location: ' . URL . 'options');
		} else
			$this->unauthorised();
	}
	function destroy($id)
	{
		if (Session::get('is_admin')) {
			if ($this->model->delete($id))
				Flash::success('Options supprimée.');
			else
				Flash::error('L\'options n\'a pas été supprimée.');
			header('Location: ' . URL . 'options');
		} else
			$this->unauthorised();
	}
};
