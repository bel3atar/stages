<div class='page-header'>
	<h1><?= $this->title ?>	<small>Stages</small>
</h1>
</div>
<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>Etudiant</th>
			<th>Entreprise</th>
			<th>Date</th>
			<th>Durée</th>
			<th>Ville</th>
			<th></th>
		</tr>
	</thead>
<tbody>
	<? foreach ($this->list as $t): ?>
		<tr>
			<td><a href="<?= URL ?>users/<?= $t['uid'] ?>"><?= $t['etudiant'] ?></a></td>
			<td>
				<a href="<?= URL ?>entreprises/<?= $t['eid'] ?>">
					<?= $t['entreprise'] ?>
				</a>
			</td>
			<td><?= $t['date']  ?></td>
			<td><?= $t['duree'] ?></td>
			<td><a href="<?= URL ?>cities/<?= $t['ctid'] ?>/stages"><?= $t['ville'] ?></a></td>
			<td><a class='btn btn-mini btn-info' href="<?= URL, 'stages/', $t['stid'] ?>"><i class='icon-eye-open'></i></a></td>
		</tr>
	<? endforeach ?>
</tbody>
</table>
<? $this->render_('pager') ?>
