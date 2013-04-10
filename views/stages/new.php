<legend>Archiver un nouveau stage</legend>
<form action="/stages/create" method="get">
	<label>Entreprise</label>
	<input type="text" list="entreprises" name="entreprise">
	<datalist id="entreprises">
		<? foreach ($this->entreprises as $e): ?>
			<option value="<?= $e['nom'] ?>">
		<? endforeach ?>
	</datalist>
</form>
