<legend>Modifier une entreprise</legend>
<form class="form-horizontal" action="/entreprises/<?= $this->entreprise['id'] ?>/update" method="get">
	<input type="hidden" name="id" value="<?= $this->entreprise['id'] ?>">
	<div class="control-group">
		<label class="control-label" for="nom">Nom</label>
		<div class="controls">
			<input type="text" value="<?= $this->entreprise['nom'] ?>" name="nom" id="nom" required autofocus>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="site">Site web</label>
		<div class="controls">
			<input type="url" name="site" value="<?= $this->entreprise['site'] ?> "id="site" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="logo">URL logo</label>
		<div class="controls">
			<input type="url" name="logo" id="logo" required value="<?= $this->entreprise['logo'] ?>">
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
