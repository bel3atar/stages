<? class Options extends Controller {
	function __construct()
	{
		parent::__construct();
		$this->require_model('option');
		$this->model = new OptionModel();
	}
	function index()
	{
		$this->view->title = 'Liste des options';
		$this->view->list  = $this->model->find_all();
		$this->view->render('options/index');
	}
	function add()
	{
		$this->view->title = 'Nouvelle option';
		$this->view->render('options/new');
	}
	function create()
	{
		$this->model->create();
		header('Location: /options');
	}
};
