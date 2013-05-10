<form enctype="multipart/form-data" class="form-horizontal" method="post" action="<?= URL ?>stages/update">
	<fieldset>
	<legend>Modifier un stage</legend>
	<input type="hidden" name="id" value="<?= $this->stage['id'] ?>">
	<div class="control-group">
		<label for="entreprise" class="control-label">Entreprise</label>
		<div class="controls">
			<select id="entreprise" name="entreprise" required>
				<? foreach ($this->entreprises as $e): ?>
					<option value="<?= $e['id'] ?>" <?= $this->stage['eid'] === $e['id'] ? 'selected' : '' ?>>
						<?= $e['nom'] ?>
					</option>
				<? endforeach ?>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label for="ville" class="control-label">Ville</label>
		<div class="controls">
			<select id="ville" name="ville" required>
				<? foreach ($this->cities as $v): ?>
					<option value="<?= $v['id'] ?>" <?= $this->stage['ctid'] === $v['id'] ? 'selected' : '' ?>>
						<?= $v['nom'] ?>
					</option>
				<? endforeach ?>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label for="description" class="control-label">Description</label>
		<div class="controls">
			<input id="description" type="text" name="description" value="<?= $this->stage['description'] ?>">
		</div>
	</div>

	<div class="control-group">
		<label for="date" class="control-label">Date</label>
		<div class="controls">
			<input value = "<?= $this->stage['date'] ?>" id="date" type="date" name="date" required>
		</div>
	</div>

	<div class="control-group">
		<label for="duree" class="control-label">Durée</label>
		<div class="controls">
			<input id="duree" type="number" min="15" max="90" step="15" value="<?= $this->stage['duree'] ?>" name="duree">
		</div>
	</div>

	<? if (Session::get('is_admin')): ?>
		<div class="control-group">
			<label class="control-label">Etudiant</label>
			<div class="controls">
				<select required name="user">
					<? foreach ($this->users as $u): ?>
						<option value="<?= $u['id'] ?>" <?= $u['id'] === $this->stage['uid'] ? 'selected' : '' ?>>
							<?= $u['nom'] ?>
						</option>
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
					<option value="<?= $p['id'] ?>" <? if ($p['id'] == $this->stage['pid']) echo 'selected' ?>><?= $p['nom'] ?></option>
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
					<option value="<?= $p['id'] ?>" <? if ($p['id'] == $this->stage['sid']) echo 'selected' ?>><?= $p['nom'] ?></option>
				<? endforeach ?>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Rapport</label>
		<div class="controls">
			<input type="hidden" name="MAX_FILE_SIZE" value="524288">
			<input type="file" name="rapport">
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
'<?= addcslashes($this->technologies[$i]['nom'], "'\\") ?>',
	<? endfor ?>
	];
function tagValidator(tag) { 
	return tags.indexOf(tag) != -1 ? true : false;
}
</script>
<script src="<?= URL ?>assets/javascripts/jquery.js"></script>
<script src="<?= URL ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= URL ?>assets/javascripts/bootstrap-filestyle-0.1.0.min.js"></script>
<script>$(":file").filestyle({buttonText: 'Parcourir...', icon: true})</script>
<script src="<?= URL ?>/assets/tagmanager/bootstrap-tagmanager.js"></script>
<script>
jQuery(".tagManager").tagsManager();
var stags = [
	<? foreach (split(',', $this->stage['ts']) as $t): ?>
		'<?= addcslashes($t, "'\\") ?>',
	<? endforeach ?>
		];
for (var i = 0; i < stags.length; ++i)
	$('.tagManager').tagsManager('pushTag', stags[i]);
</script>
	</body>
</html>
