<form enctype="multipart/form-data" class="form-horizontal" action="<?= URL ?>entreprises/<?= $this->entreprise['id'] ?>/update" method="post">
	<fieldset>
		<legend>Modifier une entreprise</legend>
		<input type="hidden" name="id" value="<?= $this->entreprise['id'] ?>">
		<div class="control-group">
			<label class="control-label" for="nom">Nom</label>
			<div class="controls">
				<input type="text" value="<?= $this->entreprise['nom'] ?>" name="nom" id="nom" required autofocus>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="site">Site web</label>
			<div class="controls">
				<input type="url" name="site" value="<?= $this->entreprise['site'] ?>" id="site" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="logo">URL logo</label>
			<div class="controls">
				<input type="hidden" name="MAX_FILE_SIZE" value="307200">
				<input type="file" name="logo" id="logo">
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
