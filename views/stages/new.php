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
				<? foreach ($this->villes as $v): ?>
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
			<input id="duree" type="range" min="15" max="90" step="15" value="30" name="date">
		</div>
	</div>

	<div class="control-group">
		<label for="password" class="control-label">Mot de passe</label>
		<div class="controls">
			<div class="input-append">
				<input id="password" type="text" name="password" required pattern=".{4,}">
				<button type="button" class="btn" onclick="generate()">Générer</button>
			</div>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Option</label>
		<div class="controls">
			<select required name="prop">
				<? foreach ($this->options as $o): ?>
					<option value="<?= $o['id'] ?>"><?= $o['nom'] ?></option>
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
