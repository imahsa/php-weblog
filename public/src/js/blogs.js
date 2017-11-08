$(document).ready(function() {
	var $data = convertXmlToJqueryObj();
	var $categories = $data.find('categories');
	var $blogs = $data.find('blogs');
	var selectedCat = $categories.find('selected').html();

	$categories.find('cat').each(function() {
		var $cat = $(this);
		var catName = $cat.html();
		var $option = $('<option></option>')
						.attr('value', catName)
						.html(catName);
		if (catName == selectedCat) {
			$option.attr('selected', 'selected');
		}
		$('#category-filters select').append($option);
	});

	$blogs.find('blog').each(function(index) {
		var $blog = $(this);

		var name = $blog.find('name').html();
		var author = $blog.find('author').html();
		var description = $blog.find('description').html();
		var postnum = $blog.find('postnum').html();

		var $title = $('<div></div>')
						.addClass('title')
						.html('Blog ' + (index + 1) + ': ' + name);
		
		var $author = $('<div></div>')
						.addClass('author')
						.html('By: ' + author);
		
		var $description = $('<div></div>')
						.addClass('description')
						.html(description);
		
		var $postnum = $('<div></div>')
						.addClass('postnum')
						.html('Number of Posts: ' + postnum);

		var $button = $('<button></button>')
						.html('View Blog')
						.click(function() {
							window.location = config.url + 'View/' + name;
						});

		var $bDiv = $('<div></div>')
					.addClass('bDiv')
					.append($button);

		var $br1 = $('<br>');
		var $br2 = $('<br>');

		var $blogDiv = $('<div></div>')
						.addClass('blog')
						.append($title, $br1, $author, $description, $postnum,$br2, $bDiv); 

		var $blogContainer = $('<div></div>')
						.addClass('blog-container')
						.append($blogDiv);

		$('.blogs').append($blogContainer);
	});

	$('#search').click(function(event) {
		event.preventDefault();
		var selectedCat = $('#category-filters select').val();
		window.location = config.url + 'blogs/' + selectedCat;
	});
})