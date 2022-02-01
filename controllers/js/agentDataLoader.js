let url = "https://kluch.me/kluch_metrics/controllers/getSingleAgentData.php";

//calls when page did load
function buildStarter(id) {
    $.post(url, {id: id, dataType: "summOfCalls"}, function(data) {
        console.log(data);
      buildFunnel('.funnel', data);
    });

    $.post(url, {id: id, dataType: "summOfSales"}, function(data) {
      console.log(data);
      buildFunnel('.funnel2', data);
    });

    $.post(url, {id: id, dataType: "objectsQuantity"}, function(data) {
      console.log(data);
      $('#agent-objects-quantity').append(data);
    });

    $.post(url, {id: id, dataType: "reportsTable"}, function(data) {
      console.log(data);
      $('#reports-table').append(data);
    });
}

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
