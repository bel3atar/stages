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
		$this->view->liste = $this->model->find_all($this->page());
		$this->view->render('entreprises/index');
	}
	function _count() { return $this->model->count(); }
	function add()
	{
		$this->view->title = 'Nouvelle entreprise';
		$this->require_model('city');
		$this->view->render('entreprises/new', FALSE);
	}
	function create()
	{
		$img = getimagesize($_FILES['logo']['tmp_name']);
		if ($img and $this->model->create($_POST)) {
			$callback = substr_replace($img['mime'], 'createfrom', 5, 1);
			$img = $callback($_FILES['logo']['tmp_name']);
			imagepng($img, "assets/images/entreprises/{$_POST['nom']}.png");
			imagedestroy($img);
			unlink($_FILES['logo']['tmp_name']);
		}
		header('Location: ' . URL . 'entreprises');
	}
	function destroy($id)
	{
		if (Session::get('is_admin')) {
			$nom = $this->model->find($id)['nom'];
			unlink("assets/images/entreprises/$nom.png");
			$this->model->destroy($id);
		}
		header('Location: ' . URL . 'entreprises');
	}
	function stages($id)
	{
		$this->view->entreprise = $this->model->find($id)['nom'];
		$this->view->title = "{$this->view->entreprise} | Stages";
		$this->view->stages = $this->model->stages($id, $this->page());
		$this->view->render('entreprises/stages');
	}
	function stages_count($id) { return $this->model->stages_count($id); }
	function people($id)
	{
		$this->view->entreprise = $this->model->find($id)['nom'];
		$this->view->title = "{$this->view->entreprise} | Responsables";
		$this->view->people = $this->model->people($id, $this->page());
		$this->view->render('entreprises/people');
	}
	function people_count($id) { return $this->model->people_count($id); }
	function edit($id)
	{
		$this->view->entreprise = $this->model->find($id);
		$this->view->title = "{$this->view->entreprise['nom']} | Modifier";
		$this->view->render('entreprises/edit');
	}
	function update()
	{
		if (Session::get('is_admin')) {
			$oldname = $this->model->find($_POST['id'])['nom'];
			if ($this->model->update($_POST)) {
				$path = 'assets/images/entreprises/';
				rename("$path/$oldname.png", "$path/{$_POST['nom']}.png");
				if ($_FILES['logo']) {
					$img = getimagesize($_FILES['logo']['tmp_name']);
					if ($img) {
						unlink("$path/{$_POST['nom']}.png");
						$callback = substr_replace($img['mime'], 'createfrom', 5, 1);
						$img = $callback($_FILES['logo']['tmp_name']);
						imagepng($img, "assets/images/entreprises/{$_POST['nom']}.png");
						imagedestroy($img);
						unlink($_FILES['logo']['tmp_name']);
					}
				}
			}
		}
		header('Location:' . URL . 'entreprises');
	}
	function show($id)
	{
		$this->view->entreprise = $this->model->find($id);
		$this->view->title = $this->view->entreprise['nom'];
		$this->view->render('entreprises/show');
	}
};
