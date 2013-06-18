<? 
$page =	$_GET['page'];
$page_max = $_GET['page_max'];
$init = 
	$page % PAGER_SIZE ? $page - $page % PAGER_SIZE + 1 : $page - PAGER_SIZE + 1;
$finl = min($init + PAGER_SIZE - 1, $page_max ? $page_max : 1);
$range = range($init, $finl);
?>
<div class='pagination pagination-centered'>
	<ul>

		<? if ($init == 1): ?>
			<li class="disabled"><a href='#'>&laquo;</a></li>
		<? else: ?>
			<li><a href="?page=<?= $init - 1 ?>">&laquo;</a></li>
		<? endif ?>

		<? foreach ($range as $p): ?>
			<li<? if ($page == $p) echo ' class="active"' ?>>
				<a href="<?= '?page=', $p ?>">
					<?= $p ?>
				</a>
			</li>
		<? endforeach ?>

		<? if ($init + PAGER_SIZE > $page_max): ?>
			<li class="disabled"><a href='#'>&raquo;</a></li>
		<? else: ?>
			<li><a href="?page=<?= $init + PAGER_SIZE ?>">&raquo;</a></li>
		<? endif ?>
	</ul>
</div>
