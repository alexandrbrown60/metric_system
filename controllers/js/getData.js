function getData(url, tag) {
	$.post(url, function(data) {
		$(tag).append(data);
	});
}