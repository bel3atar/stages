<div class='page-header'>
	<h1>
		<?= $this->user['nom'] ?>
		<small>Profil</small>
	</h1>
</div>
<div class='row-fluid'>
	<div class='well offset2 span8'>
		<div class='span2'>
			<img src='http://www.gravatar.com/avatar/<?= md5($this->user['email']) ?>' alt='<?= $this->user['nom'] ?>' class='img-polaroid'>
		</div>
		<div class='span6'>
			<address>
				<strong><?= $this->user['nom'] ?></strong> 
				<? if (Session::get('id') == $this->user['id'] or Session::get('is_admin')): ?>
					<a href="<?= URL, 'users/', $this->user['id'], '/edit' ?>"><i class='icon-pencil'></i></a>
				<? endif ?>
				<br>
				<a href='mailto:<?= $this->user['email'] ?>'><?= $this->user['email'] ?></a><br>
				<? if ($this->user['is_admin']): ?>
					<p class='badge badge-warning'>Administrateur</p>
				<? else: ?>
					<a href="<?= URL, 'options/', $this->user['optid'] ?>/students">
						<span class='badge badge-info'><?= $this->user['opt'] ?></span>
					</a>
					<? if ($this->user['stages']): ?>
						<a href="<?= URL, 'users/', $this->user['id'], '/stages' ?>">
							<span class='badge badge-info'>
								<?= $this->user['stages'] ?> stage<? if ($this->user['stages'] > 1) echo 's' ?>
							</span>
						</a>
					<? endif ?>
				<? endif ?>
			</address>
		</div>
	</div>
</div>
