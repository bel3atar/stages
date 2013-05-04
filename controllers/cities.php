<?
class Cities extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('city');
		$this->model = new CityModel();
		$this->view->controller = 'cities';
	}
	function index()
	{
		$this->view->title = 'Liste des villes';
		$this->view->list  = $this->model->find_all($this->page());
		$this->view->render('cities/index');
	}
	function _count() { return $this->model->count(); }
	function add()
	{
		$this->view->title = 'Nouvelle ville';
		$this->view->render('cities/new');
	}
	function create()
	{
		if (Session::get('logged')) {
			if ($this->model->create())
				Flash::success('Ville ajoutée avec succès');
			else
				Flash::error('La ville n\'a pas été ajoutée');
			header('Location: '. URL. 'cities');
		} else
			$this->unauthorised();
	}
	function stages($id)
	{
		$name = $this->model->find($id);
		$this->view->title = "Stages à $name";
		$this->view->ville = $name;
		$this->view->list  = $this->model->stages($id, $this->page());
		$this->view->render('cities/stages');
	}
	function stages_count($id) { return $this->model->stages_count($id); }
	function entreprises($id)
	{
		$this->view->title = "Entreprises à $name";
		$this->view->ville = $name;
		$this->view->list  = $this->model->entreprises($id);
		$this->view->render('cities/entreprises');
	}
	function edit($id)
	{
		$this->view->nom   = $this->model->find($id);
		$this->view->id    = $id;
		$this->view->title = 'Modifier une ville';
		$this->view->render('cities/edit');
	}
	function update()
	{
		if (Session::get('is_admin')) {
			if ($this->model->update($_GET))
				Flash::success('Modification réussie.');
			else
				Flash::success('La modification n\'a pas été effectuée.');
			header('Location: ' . URL . 'cities');
		} else
			$this->unauthorised();
	}
	function destroy($id)
	{
		if (Session::get('is_admin')) {
			if ($this->model->destroy($id))
				Flash::success('La ville a bien été supprimée.');
			else
				Flash::error('La ville n\'a pas été supprimée.');
			header('Location: ' . URL . 'cities');
		} else
			$this->unauthorised();
	}
};
