<?
class Cities extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('city');
		$this->model = new CityModel();
	}
	function index()
	{
		$this->view->title = 'Liste des villes';
		$this->view->list  = $this->model->find_all();
		$this->view->render('cities/index');
	}
	function add()
	{
		$this->view->title = 'Nouvelle ville';
		$this->view->render('cities/new');
	}
	function create()
	{
		$this->model->create();
		header('Location: /cities');
	}
	function stages($id)
	{
		$name = $this->model->find($id);
		$this->view->title = "Stages à $name";
		$this->view->ville = $name;
		$this->view->list  = $this->model->stages($id);
		$this->view->render('cities/stages');
	}
	function entreprises($id)
	{
		$name = $this->model->find($id);
		$this->view->title = "Entreprises à $name";
		$this->view->ville = $name;
		$this->view->list  = $this->model->entreprises($id);
		$this->view->render('cities/entreprises');
	}
};
