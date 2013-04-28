<form enctype="multipart/form-data" class="form-horizontal" method="post" action="<?= URL ?>entreprises/create">
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
			<label class="control-label" for="logo">Logo</label>
			<div class="controls">
				<input type="hidden" name="MAX_FILE_SIZE" value="307200">
				<input type="file" name="logo" id="logo" required>
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

				</div>
			</div>
		</div>
		<script src="<?= URL ?>assets/javascripts/jquery.js"></script>
		<script src="<?= URL ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?= URL ?>assets/javascripts/bootstrap-filestyle-0.1.0.min.js"></script>
		<script>$(":file").filestyle({buttonText: 'Parcourir...', icon: true})</script>
	</body>
</html>
