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
		</tr>
	<? endforeach ?>
</tbody>
</table>
<? require 'views/pager.php'; ?>
