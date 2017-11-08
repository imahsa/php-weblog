$(document).ready(function() {
	var $data = convertXmlToJqueryObj();
	var $categories = $data.find('categories');

	$categories.find('cat').each(function() {
		var $cat = $(this);
		var catName = $cat.html();
		console.log('cat names : ' + catName);
		var $option = $('<option></option>')
						.attr('value', catName)
						.html(catName);
		$('#newBlogForm select').append($option);
	});
})