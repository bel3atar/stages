<table class="table table-hover table-striped table-condensed">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Stages</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $ville): ?>
			<tr>
				<td>
					<? if ($ville['stages']): ?>
						<a href="/cities/<?= $ville['id'] ?>/stages"><?= $ville['nom'] ?></a>
					<? else: ?>
						<?= $ville['nom'] ?>
					<? endif ?>
				</td>
				<td>
					<? if ($ville['stages']): ?>
						<a href="/cities/<?= $ville['id'] ?>/stages"><?= $ville['stages'] ?></a>
					<? else: ?>
						<?= $ville['stages'] ?>
					<? endif ?>
				</td>
				<td>
					<div class="btn-group">
						<a href="/cities/<?= $ville['id'] ?>/edit" class="btn btn-warning btn-mini">
							<i class="icon-white icon-edit"></i>
						</a>
						<? if ($ville['stages'] == 0): ?>
							<a href="/cities/<?= $ville['id'] ?>/destroy" class="btn btn-danger btn-mini">
								<i class="icon-white icon-trash"></i>
							</a>
						<? endif ?>
					</div>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/cities/new" class="btn btn-primary">
	<i class="icon-plus-sign icon-white"></i>
	Nouvelle
</a>
