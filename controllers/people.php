<? class People extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('person');
		$this->model = new PersonModel();
	}
	function index()
	{
		$this->view->title = 'Liste des responsables';
		$this->view->list  = $this->model->find_all();
		$this->view->render('people/index');
	}
};


