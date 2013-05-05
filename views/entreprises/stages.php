<div class="page-header"><h1><?= $this->entreprise ?> <small>Stages</small></h1></div>
<table class="table table-striped table-condensed table-hover">
	<thead>
		<tr>
			<th>Etudiant</th>
			<th>Ville</th>
			<th>Date</th>
			<th>Duree</th>
			<th>Technologies</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->stages as $s): ?>
			<tr>
				<td>
					<a href="<?= URL ?>users/<?= $s['uid'] ?>/stages"><?= $s['student'] ?></a>
				</td>
				<td>
					<a href="<?= URL ?>cities/<?= $s['ctid'] ?>/stages"><?= $s['ville']?></a>
				</td>
				<td><?= $s['date'] ?></td>
				<td><?= $s['duree']?></td>
				<td>
					<? $ts   = explode(',', $s['ts'])   ?>
					<? $tids = explode(',', $s['tids']) ?>
					<? for ($i = sizeof($ts) - 1; $i >= 0; --$i): ?>
						<a href="<?= URL ?>technologies/<?= $tids[$i] ?>/stages"><?= $ts[$i] ?></a><?= $i ? ', ' : '' ?>
					<? endfor ?>
				</td>
				<td>
					<a href='<?= URL, 'stages/', $s['stid'] ?>' class='btn btn-mini btn-info'>
						<i class='icon-eye-open'></i>
					</a>
				</td>
			</tr>	
		<? endforeach ?>
	</tbody>
</table>
<? $this->render_('pager') ?>
