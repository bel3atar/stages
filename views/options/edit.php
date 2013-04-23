<form method="get" action="<?= URL ?>options/update" class="form-inline">
	<fieldset>
		<legend>Modifier une option</legend>
		<input type="hidden" name="id" value="<?= $this->id ?>">
		<input autofocus required type="text" value="<?= $this->nom ?>" name="nom">
		<button type="submit" class="btn btn-primary">
			<i class="icon-ok icon-white"></i>
			Enregistrer
		</button>
	</fieldset>
</form>
