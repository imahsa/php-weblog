$(document).ready(function() {
	var $data = convertXmlToJqueryObj();
	var $posts = $data.find('posts');
	var blog_address = $data.find('blogAddress').html();
	var number_of_pages = $data.find('number_of_pages').html();
	var page = $data.find('page').html();

	$posts.find('post').each(function() {
		var $post = $(this);

		//getting the values
		var title = $post.find('title').html();
		var content = $post.find('content').html();
		var author = $post.find('author').html();
		var date = $post.find('date').html();
		var commentsNum = $post.find('commentsNum').html();
		var hash = $post.find('hash').html();
		var more = $post.find('more').html();

		//creating html divs and other elements
		var $title = $('<div></div>')
						.addClass('title')

		var $post_link = $('<a></a>')
							.attr('href', config.url + 'View/' + blog_address + '/' + 0 + '/' + hash)
							.addClass('titleLink')
							.html(title);

		$title.append($post_link);

		var $content = $('<div></div>')
						.addClass('content')
						.html(content);
		
		var $author = $('<div></div>')
						.addClass('author')
						.html(author);
		
		var $date = $('<div></div>')
						.addClass('date')
						.html(date);

		var $commentsNum = $('<div></div>')
						.addClass('commentsNum')
						.html(' _ '+commentsNum + ' Comments');

		/*    **** addd var $button = $('<button></button>')
						.html('Post New Comment')
						.click(function() {
							window.location = config.url + 'View/index/' + name;
						});*/
		var $post_comment = $('<div></div>')
					.addClass('post_commnet');

		var $comment_link = $('<a></a>')
							.attr('href', config.url + 'Comments/' + blog_address + '/' + hash)
							.addClass('link')
							.html(' _ Post New Comment');
		$post_comment.append($comment_link);

		if(more){
			var $more_div = $('<div></div>')
							.addClass('more');
			var $more_link = $('<a></a>')
							.attr('href', config.url + 'View/' + blog_address + '/' + 0 + '/' + hash)
							.addClass('moreLink')
							.html('More...');
			$more_div.append($more_link);
		}


		var $br1 = $('<br>');
		var $br2 = $('<br>');
		var $br3 = $('<br>');

		var $postDiv = $('<div></div>')
						.addClass('post')
						//****** add $button
						.append($title, $br1, $content,$br3, $more_div, $br2, $author, $date, $commentsNum, $post_comment); 

		var $postContainer = $('<div></div>')
						.addClass('post-container')
						.append($postDiv);

		var $hr = $('<hr>')
					.addClass('break');

		$('.posts_div').append($postContainer, $hr);
	});

	var p;
	//$('.pages_div').html('Pages: ');
	for (p = 1; p <= number_of_pages; p++) {
		if(p != page){
			if(p != 1){
				var $page_div = $('<div></div>')
					.addClass('page');
				var $page_link = $('<a></a>')
									.attr('href', config.url + 'View/' + blog_address + '/' + p)
									.addClass('p_link')
									.html(p);
				$page_div.append($page_link);
			}
			else{
				var $page_div = $('<div></div>')
					.addClass('page');
				var $page_link = $('<a></a>')
									.attr('href', config.url + 'View/' + blog_address )
									.addClass('p_link')
									.html(p);
				$page_div.append($page_link);
			}
		}
		else{
			var $page_div = $('<div></div>')
					.addClass('page')
					.html(p);
		}
		console.log($page_div);
		$('.pages_div').append($page_div);
	}
})


