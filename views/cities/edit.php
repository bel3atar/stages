<legend>Modifier une ville</legend>
<form class="form-inline" method="get" action="/cities/update">
	<input type="hidden" name="id" value="<?= $this->id ?>">
	<input type="text" name="nom" value="<?= $this->nom ?>" autofocus required>
	<button type="submit" class="btn btn-primary">
		<i class="icon-ok icon-white"></i>
		Enregistrer
	</button>
</form>
