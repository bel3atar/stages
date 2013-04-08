<legend>Nouvel étudiant</legend>
<form class="form-horizontal" method="post" action="/user/create">
	<div class="control-group">
		<label class="control-label">Nom</label>
		<div class="controls">
			<input type="text" name="nom" required autofocus pattern=".">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Prénom</label>
		<div class="controls">
			<input type="text" name="prenom" required pattern=".">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Sexe</label>
		<div class="controls">
			<input type="radio" id="m" name="sex" value="m" checked><label for="m">Male</label>
			<input type="radio" id="f" name="sex" value="f"><label for="f">Femelle</label>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Email</label>
		<div class="controls">
			<input type="email" name="email" required pattern=".">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Mot de passe</label>
		<div class="controls">
			<input type="password" name="pass" required pattern=".{4,}">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Option</label>
		<div class="controls">
			<select required name="option">
				<? foreach ($this->options as $o): ?>
					<option value="<?= $o['id'] ?>"><?= $o['nom'] ?></option>
				<? endforeach ?>
			</select>
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<input type="submit" value="Soumettre" class="btn btn-primary">
		</div>
	</div>

</form>
