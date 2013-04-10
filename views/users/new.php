<legend>Nouvel étudiant</legend>
<form class="form-horizontal" method="post" action="/users/create">

	<div class="control-group">
		<label class="control-label">Matricule</label>
		<div class="controls">
			<span class="uneditable-input"><?= $this->lastID ?></span>
		</div>
	</div>

	<div class="control-group">
		<label for="nom" class="control-label">Nom</label>
		<div class="controls">
			<input id="nom" type="text" name="nom" required autofocus pattern="[A-Za-zïîâ]+">
		</div>
	</div>

	<div class="control-group">
		<label for="prenom" class="control-label">Prénom</label>
		<div class="controls">
			<input id="prenom" type="text" name="prenom" required pattern="[A-Za-zïîâ]+">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">Sexe</label>
		<div class="controls">
			<label class="radio">
				<input type="radio" name="sex" id="m" value="m" checked><label for="m">Male</label>
				<input type="radio" name="sex" id="f" value="f"><label for="f">Femelle</label>
			</label>
		</div>
	</div>

	<div class="control-group">
		<label for="email" class="control-label">Email</label>
		<div class="controls">
			<input id="email" type="email" name="email" required pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
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
			<select required name="option">
				<? foreach ($this->options as $o): ?>
					<option value="<?= $o['id'] ?>"><?= $o['nom'] ?></option>
				<? endforeach ?>
			</select>
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn btn-primary">
		</div>
	</div>

</form>
<script>
	function generate()
	{
		var rnd;
		do {
			rnd = Math.floor(Math.random() * 10000);
		} while (rnd < 1000);
		$('input#password').val(rnd);
	}
</script>
