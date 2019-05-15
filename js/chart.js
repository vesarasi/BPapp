window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Estimated Levelized Cost of Electricity in US by 2020"
	},
	theme: "light1",
	animationEnabled: true,
	axisY: {
		prefix: "$",
		suffix: "/Mwh",
		includeZero: false
	},
	data: [
		{
			type: "rangeColumn",
			yValueFormatString: "$#,##0/Mwh",
			toolTipContent: "{label}<br>Minimum: {y[0]}<br>Maximum: {y[1]}",
			dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
		}
	]
});
 
chart.render();
 
}