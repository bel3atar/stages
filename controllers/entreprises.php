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
	private function resized_image($img, $h, $w)
	{
		$maximum = max($h, $w);
		if ($maximum > 300) {
			$ratio = 300 / $maximum;
			list($nw, $nh) = [ceil($w * $ratio), ceil($h * $ratio)];
			$new_img = imagecreatetruecolor($nw, $nh);
			imagealphablending($new_img, FALSE);
			imagesavealpha($new_img, TRUE);
			$transparent = imagecolorallocatealpha($new_img, 255, 255, 255, 127);
			imagefilledrectangle($new_img, 0, 0, $nw, $nh, $transparent);
			imagecopyresampled($new_img, $img, 0, 0, 0, 0, $nw, $nh, $w, $h);
			imagedestroy($img);
			$img = $new_img;
		}
		return $img;
	}
	function create()
	{
		if (Session::get('logged')) {
			$img_info = getimagesize($_FILES['logo']['tmp_name']);
			if ($img_info and $this->model->create($_POST)) {
				list($w, $h) = $img_info;
				$callback = substr_replace($img_info['mime'], 'createfrom', 5, 1);
				$img = $callback($_FILES['logo']['tmp_name']);
				$img = $this->resized_image($img, $h, $w);
				imagepng($img, "assets/images/entreprises/{$_POST['nom']}.png");
				imagedestroy($img);
				unlink($_FILES['logo']['tmp_name']);
				Flash::success('L\'entreprise a bien été ajoutée.');
			} else
				Flash::error('L\'entreprise n\'a pas été ajoutée.');
			header('Location: ' . URL . 'entreprises');
		} else
			$this->unauthorised();
	}
	function destroy($id)
	{
		if (Session::get('is_admin')) {
			$nom = $this->model->find($id)['nom'];
			unlink("assets/images/entreprises/$nom.png");
			$this->model->destroy($id);
			Flash::success('L\'entreprise a bien été supprimée.');
			header('Location: ' . URL . 'entreprises');
		} else
			$this->unauthorised();
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
				//si une image est attachée
				if ($img_info = getimagesize($_FILES['logo']['tmp_name'])) {
					list($w, $h) = $img_info;
					$callback = substr_replace($img_info['mime'], 'createfrom', 5, 1);
					$img = $callback($_FILES['logo']['tmp_name']);
					$img = $this->resized_image($img, $h, $w);
					imagepng($img, "assets/images/entreprises/{$_POST['nom']}.png");
					imagedestroy($img);
					unlink($_FILES['logo']['tmp_name']);
				}
				Flash::success('Les détails de l\'entreprise ont bien été mis à jour.');
			}
			header('Location: ' . URL . 'entreprises');
		} else
			$this->unauthorised();
	}
	function show($id)
	{
		$this->view->entreprise = $this->model->find($id);
		$this->view->title = $this->view->entreprise['nom'];
		$this->view->render('entreprises/show');
	}
};
