$(document).ready(function() {
	var $data = convertXmlToJqueryObj();
	var $myBlogs = $data.find('myBlogs');


	$myBlogs.find('blog').each(function(index) {
		var $blog = $(this);

		var name = $blog.find('name').html();
		var description = $blog.find('description').html();
		var postnum = $blog.find('postnum').html();

		var $title = $('<div></div>')
						.addClass('title')
						.html('Blog ' + (index + 1) + ': ' + name);
		
		var $description = $('<div></div>')
						.addClass('description')
						.html(description);
		
		var $postnum = $('<div></div>')
						.addClass('postnum')
						.html('(' + postnum + ')');
		
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
		var $br3 = $('<br>');

		var $blogDiv = $('<div></div>')
						.addClass('blog')
						.append($title, $br1, $description, $br2, $postnum, $br3, $bDiv); 

		var $blogContainer = $('<div></div>')
						.addClass('blog-container')
						.append($blogDiv);

		$('.my_blogs').append($blogContainer);
	});
})