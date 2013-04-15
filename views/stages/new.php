<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->title ?></title>
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/assets/tagmanager/bootstrap-tagmanager.css">
	<link rel="icon" href="/assets/favicon.ico">
</head>
<body>
<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="/">Archive de stages</a>
		<ul class="nav">
			<li class="pull-right"><a href="#">Se connecter</a>
		</ul>
	</div>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span2">
			<ul class="nav nav-list">
				<li class="nav-header">Menu</li>
				<? foreach ($this->controllers as $k => $v): ?>
					<li class="<?= $k === $this->controller ? 'active' : '' ?>">
						<a href="/<?= $k ?>"><?= $v ?></a>
					</li>
				<? endforeach ?>
			</ul>
		</div>
		<div class="span10">

		<legend>Archiver un nouveau stage</legend>
		<form class="form-horizontal" method="get" action="/stages/create">

			<div class="control-group">
				<label for="entreprise" class="control-label">Entreprise</label>
				<div class="controls">
					<select id="entreprise" name="entreprise" required>
						<? foreach ($this->entreprises as $e): ?>
							<option value="<?= $e['id'] ?>"><?= $e['nom'] ?></option>
						<? endforeach ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label for="ville" class="control-label">Ville</label>
				<div class="controls">
					<select id="ville" name="ville" required>
						<? foreach ($this->cities as $v): ?>
							<option value="<?= $v['id'] ?>"><?= $v['nom'] ?></option>
						<? endforeach ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label for="date" class="control-label">Date</label>
				<div class="controls">
					<input id="date" type="date" name="date" required>
				</div>
			</div>

			<div class="control-group">
				<label for="duree" class="control-label">Durée</label>
				<div class="controls">
					<input id="duree" type="number" min="15" max="90" step="15" value="30" name="duree">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Etudiant</label>
				<div class="controls">
					<select required name="user">
						<? foreach ($this->users as $u): ?>
							<option value="<?= $u['id'] ?>"><?= $u['nom'] ?></option>
						<? endforeach ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Technologies</label>
				<div class="controls">
					<input type="text"  name="tags" data-provide="typeahead" autocomplete="off" placeholder="Technologies" class="tagManager">
					<datalist id="technologies">
						<? foreach ($this->technologies as $t): ?>
							<option value="<?= $t['nom'] ?>">
						<? endforeach ?>
					</datalist>
				</div>
			</div>

			<div class="control-group">
				<label required class="control-label">Proposé par</label>
				<div class="controls">
					<select name="proposer">
						<? foreach ($this->people as $p): ?>
							<option value="<?= $p['id'] ?>"><?= $p['nom'] ?></option>
						<? endforeach ?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Supervisé par</label>
				<div class="controls">
					<select name="supervisor">
						<option value=""></option>
						<? foreach ($this->people as $p): ?>
							<option value="<?= $p['id'] ?>"><?= $p['nom'] ?></option>
						<? endforeach ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn btn-primary">
						<i class="icon-ok icon-white"></i>
						Enregistrer
					</button>
				</div>
			</div>

		</form>

		</div>
		</div>
		<script>
			var tags = [
				<? for($i = sizeof($this->technologies) - 1; $i >= 0; --$i): ?>
					'<?= $this->technologies[$i]['nom'] ?>'<?= $i ? ',':'' ?>
				<? endfor ?>
			];
			function tagValidator(tag) { 
				return tags.indexOf(tag) != -1 ? true : false;
			}
		</script>
		<script src="/assets/javascripts/jquery.js"></script>
		<script src="/assets/tagmanager/bootstrap-tagmanager.js"></script>
		<script src="/assets/bootstrap/js/bootstrap.js"></script>
		<script>jQuery(".tagManager").tagsManager();</script>
	</body>
</html>
