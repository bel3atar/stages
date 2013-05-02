<? class People extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('person');
		$this->model = new PersonModel();
		$this->view->controller = 'people';
	}
	function index()
	{
		$this->view->title = 'Liste des responsables';
		$this->view->list  = $this->model->find_all($this->page());
		$this->view->render('people/index');
	}
	function add()
	{
		$this->view->title = 'Nouveau responsable';
		$this->require_model('entreprise');
		$e = new EntrepriseModel();
		$this->view->entreprises = $e->find_all();
		$this->view->render('people/new');
	}
	function create()
	{
		if (Session::get('logged'))
			if ($this->model->create($_GET))
				Flash::success('Responsable ajouté.');
			else
				Flash::error('Echec de l\'ajout du responsable.');
		header('Location: ' . URL . 'people');
	}
	function destroy($id)
	{
		if (Session::get('is_admin'))
			if ($this->model->destroy($id))
				Flash::success('Responsable supprimé');
			else
				Flash::error('Echec de la suppression du responsable.');
		header('Location: ' . URL . 'people');
	}
	function edit($id)
	{
		$this->require_model('entreprise');
		$e = new EntrepriseModel();
		$this->view->entreprises = $e->find_all();
		$this->view->person      = $this->model->find($id);
		$this->view->title       = $this->view->person['nom'];
		$this->view->render('people/edit');
	}
	function update()
	{
		if (Session::get('is_admin'))
			if ($this->model->update($_GET))
				Flash::success('Modifications enregistrées.');
			else
				Flash::error('Mise à jour non effectuée.');
		header('Location: ' . URL . 'people');
	}
	function _count() { return $this->model->count(); }
};
