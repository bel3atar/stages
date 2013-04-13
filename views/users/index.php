<legend>Liste des étudiants</legend>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Nom complet</th>
			<th>Né(e) le</th>
			<th>Opt.</th>
			<th>Téléphone</th>
			<th>Email</th>
			<th>Stages</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->liste as $etd): ?>
			<tr>
				<td><?= $etd['id'] ?></td>
				<td>
					<a href="/users/<?= $etd['id'] ?>/stages">
						<?= $etd['nom'] ?>
					</a>
				</td>
				<td><?= $etd['ne_le'] ?></td>
				<td>
					<a href="/options/<?= $etd['optid'] ?>/students"><?= $etd['opt'] ?></a>
				</td>
				<td><?= $etd['tel'] ?></td>
				<td><?= $etd['email'] ?></td>
				<td>
					<? if ($etd['stages']): ?>
						<a href="/users/<?= $etd['id'] ?>/stages">
							<?= $etd['stages'] ?>
						</a>
					<? else: ?>
						0
					<? endif ?>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<a href="/users/new" class="btn btn-primary">
	<i class="icon-white icon-plus-sign"></i>
	Nouveau
</a>
