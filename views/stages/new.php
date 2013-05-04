<form enctype='multipart/form-data' class="form-horizontal" method="post" action="<?= URL ?>stages/create">
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
				<input type="hidden" name="user" value="<?= Session::get('id') ?>">
				<span class="uneditable-input"><?= Session::get('nom') ?></span>
			</div>
		</div>
	<? endif ?>

	<div class="control-group">
		<label for="description" class="control-label">Description</label>
		<div class="controls">
			<input id="description" type="text" name="description">
		</div>
	</div>

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
			<input id="duree" type="number" min="15" max="240" step="15" value="30" name="duree">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Technologies</label>
		<div class="controls">
			<input type="text"  name="tags" data-provide="typeahead" autocomplete="off" placeholder="Technologies" class="tagManager">
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
		<label class="control-label">Rapport</label>
		<div class="controls">
			<input type="hidden" name="MAX_FILE_SIZE" value="524288">
			<input type='file' name='report'>
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
		<script src="<?= URL ?>assets/javascripts/jquery.js"></script>
		<script src="<?= URL ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?= URL ?>assets/javascripts/bootstrap-filestyle-0.1.0.min.js"></script>
		<script>$(":file").filestyle({buttonText: 'Parcourir...', icon: true})</script>
		<script src="<?= URL ?>assets/tagmanager/bootstrap-tagmanager.js"></script>
		<script>
			var tags = [
				<? for($i = sizeof($this->technologies) - 1; $i >= 0; --$i): ?>
					'<?= addcslashes($this->technologies[$i]['nom'], "'\\") ?>',
				<? endfor ?>
			];
			function tagValidator(tag) { 
				return tags.indexOf(tag) != -1 ? true : false;
			}
			jQuery(".tagManager").tagsManager();
		</script>
	</body>
</html>
