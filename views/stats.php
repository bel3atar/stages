<div class='page-header'>
  <h1>Bienvenue <small>statistiques</small></h1>
</div>
<script src="https://www.google.com/jsapi"></script>
<script>
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = google.visualization.arrayToDataTable([
			<? foreach ($this->arr as $t): ?>
				['<?= addcslashes($t['nom'], "'\\") ?>', <?= $t['c'] ?>],
			<? endforeach ?>
		]);

		var options = {
			title: 'Popularité des technologies'
		};

		var chart = 
			new google.visualization.PieChart(document.getElementById('chart_div'));
		chart.draw(data, options);
	}
</script>
<div id='chart_div'></div>
