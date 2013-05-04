<? extract($this->stage); $ts = explode(',', $ts); $tids = explode(',', $tids) ?>
<div class='page-header'>
  <h1>Détails du stage</h1>
</div>
<dl class='dl-horizontal'>
	<dt>Etudiant</dt><dd><a href='<?= URL, 'users/', $uid ?>'><?= $u ?></a></dd>

	<dt>Entreprise</dt><dd><a href='<?= URL, 'entreprises/', $eid ?>'><?= $e ?></a></dd>

	<dt>Date</dt><dd><?= $date ?></dd>

	<dt>Durée</dt><dd><?= $duree ?></dd>

	<dt>Technologies</dt>
	<dd>
		<? for ($i = sizeof($ts) - 1; $i >= 0; --$i): ?>
			<a href='<?= URL, 'technologies/', $tids[$i], '/stages' ?>'><?= $ts[$i] ?></a><? if ($i) echo ', ' ?>
		<? endfor ?>
	</dd>

	<dt>Proposeur</dt><dd><?= $p ?> <strong><?= $pemail ?></strong></dd>

	<dt>Superviseur</dt><dd><? if($s): ?><?= $s ?> <strong><?= $semail ?></strong><? else: ?>-<? endif ?></dd>

	<dt>Rapport</dt><dd><? if (isset($rapport)): ?><a href='<?= URL, $rapport ?>'>Télécharger</a><? else: ?>-<? endif ?></dd>

</dl>
