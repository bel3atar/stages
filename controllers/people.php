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
		$this->view->list  = $this->model->find_all();
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
		$this->model->create($_GET);
		header('Location: /people');
	}
	function destroy($id)
	{
		$this->model->destroy($id);
		header('Location: /people');
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
		$this->model->update($_GET);
		header('Location: /people');
	}
};
