				</div>
			</div>
		</div>
		<script src="<?= URL ?>assets/javascripts/jquery.js"></script>
		<script src="<?= URL ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<? if (isset($this->scripts)) foreach ($this->scripts as $s): ?>
			<script <?= $s ?>></script>
		<? endforeach ?>
	</body>
</html>
