<form class="form-horizontal" method="get" action="<?= URL ?>entreprises/create">
	<fieldset>
		<legend>Nouvelle entreprise</legend>
		<div class="control-group">
			<label class="control-label" for="nom">Nom</label>
			<div class="controls">
				<input type="text" name="nom" id="nom" required autofocus>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="tel">Téléphone</label>
			<div class="controls">
				<input type="tel" name="tel" id="tel" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="site">Site web</label>
			<div class="controls">
				<input type="url" name="site" id="site" required placeholder="http://example.com">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="logo">URL logo</label>
			<div class="controls">
				<input type="url" name="logo" id="logo" required value="http://example.com/image.png">
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
