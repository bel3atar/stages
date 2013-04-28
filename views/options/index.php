<div class='page-header'><h1>Liste des options</h1></div>
<table class="table table-hover table-condensed table-striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Etudiants</th>
			<? if (Session::get('is_admin')) echo '<th></th>' ?>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $option): ?>
			<tr>
				<td>
					<? if ($option['etudiants']): ?>
						<a href="<?= URL ?>options/<?= $option['id'] ?>/students">
							<?= $option['nom'] ?>
						</a>
					<? else: ?>
						<?= $option['nom'] ?>
					<? endif ?>
				</td>
				<td>
					<? if ($option['etudiants']): ?>
						<a href="<?= URL ?>options/<?= $option['id'] ?>/students">
							<?= $option['etudiants'] ?>
						</a>
					<? else: ?>
						<?= $option['etudiants'] ?>
					<? endif ?>
				</td>
				<? if (Session::get('is_admin')): ?>
					<td>
						<div class="btn-group">
							<a href="<?= URL ?>options/<?= $option['id'] ?>/edit" class="btn btn-warning btn-mini">
								<i class="icon-white icon-edit"></i>
							</a>
							<? if ($option['etudiants'] == 0): ?>
								<a href="<?= URL ?>options/<?= $option['id'] ?>/destroy" class="btn btn-danger btn-mini">
									<i class="icon-white icon-trash"></i>
								</a>
							<? endif ?>
						</div>
					</td>
				<? endif ?>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<? if (Session::get('logged')): ?>
	<a href="<?= URL ?>options/new" class="pull-right btn btn-primary">
		<i class="icon-plus-sign icon-white"></i>
		Nouvelle
	</a>
<? endif ?>
