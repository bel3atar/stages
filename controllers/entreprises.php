<?
class Entreprises extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('entreprise');
		$this->model = new EntrepriseModel();
		$this->view->controller = 'entreprises';
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
	function create()
	{
		$this->model->create($_GET);
		header('Location: /entreprises');
	}
	function destroy($id)
	{
		if (Session::get('is_admin'))
			$this->model->destroy($id);
		header('Location: /entreprises');
	}
	function stages($id)
	{
		$this->view->entreprise = $this->model->find($id)['nom'];
		$this->view->title = "{$this->view->entreprise} | Stages";
		$this->view->stages = $this->model->stages($id);
		$this->view->render('entreprises/stages');
	}
	function people($id)
	{
		$this->view->entreprise = $this->model->find($id)['nom'];
		$this->view->title = "{$this->view->entreprise} | Responsables";
		$this->view->people = $this->model->people($id);
		$this->view->render('entreprises/people');
	}
	function edit($id)
	{
		$this->view->entreprise = $this->model->find($id);
		$this->view->title = "{$this->view->entreprise['nom']} | Modifier";
		$this->view->render('entreprises/edit');
	}
	function update()
	{
		if (Session::get('is_admin'))
			$this->model->update($_GET);
		header('Location: /entreprises');
	}
	function show($id)
	{
		$this->view->entreprise = $this->model->find($id);
		$this->view->title = $this->view->entreprise['nom'];
		$this->view->render('entreprises/show');
	}
};
