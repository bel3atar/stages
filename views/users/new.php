<form class="form-horizontal" method="get" action="<?= URL ?>users/create">
<fieldset>
<legend>Nouvel étudiant</legend>

	<div class="control-group">
		<label for="nom" class="control-label">Nom</label>
		<div class="controls">
			<input id="nom" type="text" name="nom" autofocus><!-- required pattern="[A-Za-zïîâ]+" -->
		</div>
	</div>

	<div class="control-group">
		<label for="prenom" class="control-label">Prénom</label>
		<div class="controls">
			<input id="prenom" type="text" name="prenom"><!-- required pattern="[A-Za-zïîâ]+" -->
		</div>
	</div>

	<div class="control-group">
		<label for="email" class="control-label">Email</label>
		<div class="controls">
			<input id="email" type="email" name="email"><!-- required pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" -->
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
			<button type="submit" class="btn btn-primary">
				<i class="icon-ok icon-white"></i>
				Enregistrer
			</button>
		</div>
	</div>
</fieldset>
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
