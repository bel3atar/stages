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
		<label class="control-label">Proposé par</label>
		<div class="controls">
			<select name="proposer">
				<option value=""></option>
				<? foreach ($this->people as $p): ?>
					<option value="<?= $p['id'] ?>"><?= $p['nom'] ?></option>
				<? endforeach ?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Supervisé par</label>
		<div class="controls">
			<select required name="supervisor">
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
