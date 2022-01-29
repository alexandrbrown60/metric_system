$(document).ready(function() {
	//getting agent data
	let url = "https://kluch.me/kluch_metrics/controllers/getSingleAgentData.php";
	$.post(url, {id: 2}, function(data) {
		buildFunnel('.funnel', data);
	})
});

function buildFunnel(tag, data) {
	var graph = new FunnelGraph({
      container: tag,
      gradientDirection: 'horizontal',
      data: JSON.parse(data),
      displayPercent: true,
      direction: 'vertical',
      width: 300,
      height: 600,
      subLabelValue: 'raw'
    });

    graph.draw();
}
