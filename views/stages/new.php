<form class="form-horizontal" method="get" action="<?= URL ?>stages/create">
<fieldset>
<legend>Archiver un nouveau stage</legend>

	<? if (Session::get('is_admin')): ?>
		<div class="control-group">
			<label class="control-label">Etudiant</label>
			<div class="controls">
				<select name="user">
					<? foreach ($this->users as $u): ?>
						<option value="<?= $u['id'] ?>"><?= $u['nom'] ?></option>
					<? endforeach ?>
				</select>
			</div>
		</div>
	<? else: ?>
		<div class="control-group">
			<label class="control-label">Etudiant</label>
			<div class="controls">
				<span class="uneditable-input"><?= Session::get('nom') ?></span>
			</div>
		</div>
	<? endif ?>

	<div class="control-group">
		<label for="entreprise" class="control-label">Entreprise</label>
		<div class="controls">
			<select id="entreprise" name="entreprise">
				<? foreach ($this->entreprises as $e): ?>
					<option value="<?= $e['id'] ?>"><?= $e['nom'] ?></option>
				<? endforeach ?>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label for="ville" class="control-label">Ville</label>
		<div class="controls">
			<select id="ville" name="ville">
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
		<label class="control-label">Proposé par</label>
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

</fieldset>
</form>


				</div>
			</div>
		</div>
<script>
	var tags = [
		<? for($i = sizeof($this->technologies) - 1; $i >= 0; --$i): ?>
			'<?= str_replace('\'', '\\\'', $this->technologies[$i]['nom']) ?>',
		<? endfor ?>
	];
	function tagValidator(tag) { 
		return tags.indexOf(tag) != -1 ? true : false;
	}
</script>
		<script src="<?= URL ?>assets/javascripts/jquery.js"></script>
		<script src="<?= URL ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<? if (isset($this->scripts)) foreach ($this->scripts as $s): ?>
			<script<?= $s ?></script>
		<? endforeach ?>
	</body>
</html>
