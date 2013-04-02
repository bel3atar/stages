<form action="/stages/create" method="get">
	<fieldset>
		<legend>Archiver un nouveau stage</legend>
		<label>Entreprise</label>
		<input type="text" list="entreprises" name="entreprise">
		<datalist id="entreprises">
			<? foreach ($this->entreprises as $e): ?>
				<option value="<?= $e['nom'] ?>">
			<? endforeach ?>
		</datalist>
	</fieldset>
</form>
