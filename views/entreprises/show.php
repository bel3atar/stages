<div class='page-header'>
	<h1><?= $this->entreprise['nom']?><small> Informations</small></h1>
</div>
<div class='row-fluid'>
	<div class='well offset2 span8'>
		<div class='span2'>
			<img src='<?= URL, 'assets/images/entreprises/', $this->entreprise['nom'], '.png' ?>' alt='<?= $this->entreprise['nom'] ?>' class='img-polaroid'>
		</div>
		<div class='span6'>
			<address>
				<strong><?= $this->entreprise['nom'] ?></strong><br>
				<a href='<?= $this->entreprise['site'] ?>'><?= $this->entreprise['site'] ?></a><br>
				<? if ($this->entreprise['stages']): ?>
					<a href="<?= URL, 'entreprises/', $this->entreprise['id'], '/stages' ?>">
						<span class='badge badge-info'>
							<?= $this->entreprise['stages'] ?> stage<? if ($this->entreprise['stages'] > 1) echo 's' ?>
						</span>
					</a>
				<? endif ?>
				<? if ($this->entreprise['responsables']): ?>
					<a href="<?= URL, 'entreprises/', $this->entreprise['id'], '/people' ?>">
						<span class='badge badge-info'>
							<?= $this->entreprise['responsables'] ?> responsable<? if ($this->entreprise['responsables'] > 1) echo 's' ?>
						</span>
					</a>
				<? endif ?>
			</address>
		</div>
	</div>
</div>
