<div class="page-header"><h1><?= $this->name ?> <small> Étudiants</small></h1></div>
<table class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nom complet</th>
			<th>Né(e) le</th>
			<th>Téléphone</th>
			<th>Email</th>
			<th>Stages</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $e): ?>
			<tr>
				<td><?= $e['id'] ?></td>
				<td><a href="<?= URL ?>users/<?= $e['id'] ?>"><?= $e['nom'] ?></a></td>
				<td><?= $e['ne_le'] ?></td>
				<td><?= $e['tel'] ?></td>
				<td><?= $e['email'] ?></td>
				<td>
					<? if ($e['stagecount']): ?>
						<a href='<?= URL, 'users/', $e['id'], '/stages' ?>'>
							<?= $e['stagecount'] ?>
						</a>
					<? else: ?>
						0
					<? endif ?>
				</td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<? $this->render_('pager') ?>
