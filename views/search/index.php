<form class='form-horizontal' method='get' action='<?= URL, 'search/run' ?>'>
	<fieldset>
		<legend>Nouvelle recherche</legend>
		<div class='control-group'>
			<label class='control-label'>Ville</label>
			<div class='controls'>
				<select name='city'>
					<option value='%'></option>
					<? foreach ($this->cities as $ct): ?>
						<option value='<?= $ct['id'] ?>'>
							<?= $ct['nom'] ?>
						</option>	
					<? endforeach ?>
				</select>
			</div>
		</div>

		<div class='control-group'>
			<label class='control-label'>Technologie(s)</label>
			<div class='controls'>
				<input type="text" name="tags" data-provide="typeahead" autocomplete="off" placeholder="Technologies" class="tagManager">
			</div>
		</div>
		<div class='control-group'>
			<div class='controls'>
				<button class='btn btn-primary' type='submit'>
					<i class='icon-search icon-white'></i>
					Chercher
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
		<script src="<?= URL ?>assets/tagmanager/bootstrap-tagmanager.js"></script>
		<script>
			var tags = [
				<? for($i = sizeof($this->technologies) - 1; $i >= 0; --$i): ?>
					'<?= addcslashes($this->technologies[$i]['nom'], "'\\") ?>',
				<? endfor ?>
			];
			function tagValidator(tag) { 
				return tags.indexOf(tag) != -1 ? true : false;
			}
			jQuery(".tagManager").tagsManager();
		</script>
	</body>
</html>
