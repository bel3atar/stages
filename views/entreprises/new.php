<legend>Nouvelle entreprise</legend>
<form class="form-horizontal" method="get" action="/entreprises/create">
	<div class="control-group">
		<label class="control-label" for="nom">Nom</label>
		<div class="controls">
			<input type="text" name="nom" id="nom" required autofocus>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Ville</label>
		<div class="controls">
			<select name="ville">
				<? foreach ($this->villes as $v): ?>
					<option value="<?= $v['id'] ?>">
						<?= $v['nom'] ?>
					</option>
				<? endforeach ?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="adr">Adresse</label>
		<div class="controls">
			<input type="text" name="adr" id="adr" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="tel">Téléphone</label>
		<div class="controls">
			<input type="text" name="tel" id="tel" required>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn btn-primary">
		</div>
	</div>
</form>
