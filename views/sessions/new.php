<form action="<?= URL ?>sessions/create" method="post" class="form-horizontal">
<fieldset>
<legend>Se connecter</legend>
	<div class="control-group">
		<label for="login" class="control-label">Email</label>
		<div class="controls">
			<div class='input-prepend'>
				<span class='add-on'><i class='icon-envelope'></i></span>
				<input id="login" autofocus type="email" name="login">
			</div>
		</div>
	</div>
	<div class="control-group">
		<label for="password" class="control-label">Mot de passe</label>
		<div class="controls">
			<div class='input-prepend'>
				<span class='add-on'><i class='icon-lock'></i></span>
				<input id="password" type="password" name="password">
			</div>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-primary">
				<i class="icon-ok icon-white"></i>
				Se connecter
			</button>
		</div>
	</div>
</fieldset>
</form>
