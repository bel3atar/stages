<div class='page-header'>
	<h1>Liste des entreprises</h1>
</div>
<table class="table table-condensed table-striped table-hover">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Personnel</th>
			<th>Stages</th>
			<? if (Session::get('is_admin')) echo '<th></th>' ?>
		</tr>
	</thead>
	<tbody>
		<? foreach ($this->liste as $e): ?>
			<tr>
				<td>
					<a href="<?= URL ?>entreprises/<?= $e['id'] ?>">
						<?= $e['nom'] ?>
					</a>
				</td>
				<td>
					<? if ($e['personnel']): ?>
						<a href="<?= URL ?>entreprises/<?= $e['id'] ?>/people">
							<?= $e['personnel'] ?>
						</a>
					<? else: ?>
							<?= $e['personnel'] ?>
					<? endif ?>
				</td>
				<td>
					<? if ($e['stages']): ?>
						<a href="<?= URL ?>entreprises/<?= $e['id'] ?>/stages">
							<?= $e['stages'] ?>
						</a>
					<? else: ?>
						<?= $e['stages'] ?>
					<? endif ?>
				</td>
				<? if (Session::get('is_admin')): ?>
					<td>
						<div class="btn-group">
							<a href="<?= URL ?>entreprises/<?= $e['id'] ?>/edit" class="btn btn-warning btn-mini">
								<i class="icon-white icon-edit"></i>
							</a>
							<? if ($e['stages'] == 0 and $e['personnel'] == 0): ?>
								<a href="<?= URL ?>entreprises/<?= $e['id'] ?>/destroy" class="btn btn-danger btn-mini">
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
	<a href="<?= URL ?>entreprises/new" class="pull-right btn btn-primary">
		<i class="icon-white icon-plus-sign"></i>
		Nouvelle
	</a>
<? endif ?>
<? require 'views/pager.php' ?>
