<legend>Modifier une option</legend>
<form method="get" action="/options/update" class="form-inline">
	<input type="hidden" name="id" value="<?= $this->id ?>">
	<input autofocus required type="text" value="<?= $this->nom ?>" name="nom">
	<button type="submit" class="btn btn-primary">
		<i class="icon-ok icon-white"></i>
		Enregistrer
	</button>
</form>
