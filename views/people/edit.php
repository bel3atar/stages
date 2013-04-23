<form class="form-horizontal" method="get" action="<?= URL ?>people/update">
<fieldset>
<legend>Editer les informations d'un responsable</legend>

	<input type="hidden" name="id" value="<?= $this->person['id'] ?>">
	
	<div class="control-group">
		<label for="nom" class="control-label">Nom</label>
		<div class="controls">
			<input id="nom" type="text" name="nom" required autofocus pattern="[A-Za-zïîâ]+" value="<?= $this->person['nom'] ?>">
		</div>
	</div>

	<div class="control-group">
		<label for="prenom" class="control-label">Prénom</label>
		<div class="controls">
			<input id="prenom" type="text" name="prenom" required pattern="[A-Za-zïîâ]+" value="<?= $this->person['prenom'] ?>">
		</div>
	</div>

	<div class="control-group">
		<label for="email" class="control-label">Email</label>
		<div class="controls">
			<input id="email" type="email" name="email" required pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?= $this->person['email'] ?>">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Entreprise</label>
		<div class="controls">
			<select required name="entreprise">
				<? foreach ($this->entreprises as $e): ?>
				<option value="<?= $e['id'] ?>" <?= $e['id'] == $this->person['eid'] ? 'selected' : '' ?>>
						<?= $e['nom'] ?>
					</option>
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
