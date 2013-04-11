<legend>Renommer une technologie</legend>
<form class="form-inline" method="get" action="/technologies/update">
	<input type="hidden" name="id" value="<?= $this->id ?>">
	<input type="text" name="nom" value="<?= $this->nom ?>" autofocus required>
	<button class="btn btn-primary" type="submit">
		<i class="icon-ok icon-white"></i>
		Enregistrer
	</button>
</form>
