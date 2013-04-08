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
	function show($id)
	{
		$this->view->title = $this->model->find($id);
		$this->view->ville = $this->model->find($id);
		$this->view->list  = $this->model->stages($id);
		$this->view->render('cities/show');
	}
};
