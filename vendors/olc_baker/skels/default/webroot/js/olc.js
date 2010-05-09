function dialogFull(linkObject, title) {
	if ($('#dialogFull').length == 0) {
		$('body').append('<div id="dialogFull"></div>');
		$('#dialogFull').dialog( {
			autoOpen : false,
			width : 950
		});
	}
	if (typeof title == 'undefined') {
		if (typeof linkObject.rel == 'undefined') {
			title = '--';
		} else {
			title = linkObject.rel;
		}
	}
	$('#dialogFull').load(linkObject.href, null, function() {
		$(this).dialog('option', 'title', title).dialog('open');
	});
}