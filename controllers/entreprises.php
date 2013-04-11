<?
class Entreprises extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('entreprise');
		$this->model = new EntrepriseModel();
	}
	function show($id)
	{
		$this->view->entreprise = $this->model->find($id);
		$this->view->title = $this->view->entreprise['nom'];
		$this->view->branches   = $this->model->branches($id);
		$this->view->render('entreprises/show');
	}
	function index()
	{
		$this->view->title = 'Liste des entreprises';
		$this->view->liste = $this->model->find_all();
		$this->view->render('entreprises/index');
	}
	function add()
	{
		$this->view->title = 'Nouvelle entreprise';
		$this->require_model('city');
		$c = new CityModel();
		$this->view->villes = $c->find_all();
		$this->view->render('entreprises/new');
	}
	function branches_json($id)
	{
		header('Content-Type: application/json');
		echo json_encode($this->model->branches($id));
	}
};
