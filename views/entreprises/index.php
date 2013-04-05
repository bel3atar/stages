<ul>
	<? foreach ($this->liste as $e): ?>
		<li><a href="/entreprises/<?= $e['id'] ?>"><?= $e['nom'] ?></a></li>
	<? endforeach ?>
</ul>
