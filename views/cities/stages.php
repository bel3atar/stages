<div class='page-header'>
	<h1><?= $this->ville ?> <small>Liste des stages</small></h1>
</div>
<table class="table table-hover table-condensed table-striped">
	<thead>
		<tr>
			<th>Entreprise</th>
			<th>Date</th>
			<th>Durée</th>
			<th>Technologies</th>
				<th></th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->list as $s): ?>
			<tr>
				<td>
					<a href="<?= URL ?>entreprises/<?= $s['entrepriseid'] ?>">
						<?= $s['entreprise'] ?>
					</a>
				</td>
				<td><?= $s['date'] ?></td>
				<td><?= $s['duree'] ?></td>
				<? $ts = explode(',', $s['tnames']) ?>
				<? $tids = explode(',', $s['tids']) ?>
				<td>
					<? for ($i = sizeof($ts) - 1; $i >= 0; --$i): ?>
							<a href="<?= URL ?>technologies/<?= $tids[$i] ?>/stages">
							<?= $ts[$i] ?></a><?= $i ? ', ' : null ?>
					<? endfor ?>
				</td>
				<td><a class='btn btn-info btn-mini' href='<?= URL, 'stages/', $s['stageid'] ?>'><i class='icon-eye-open'></i></a></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>
<? $this->render_('pager') ?>
