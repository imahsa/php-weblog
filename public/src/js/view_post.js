$(document).ready(function() {
	var $data = convertXmlToJqueryObj();
	var $post = $data.find('post');
	var $comments = $data.find('comments');
	var blog_address = $data.find('blogAddress').html();
	//console.log($post);

	//getting the values
	var title = $post.find('title').html();
	var content = $post.find('content').html();
	var author = $post.find('author').html();
	var date = $post.find('date').html();
	var commentsNum = $post.find('commentsNum').html();
	var hash = $post.find('hash').html();

	//creating html divs and other elements
	var $title = $('<div></div>')
					.addClass('title')
					.html(title);

	var $content = $('<div></div>')
					.addClass('content')
					.html(content);
		
	var $author = $('<div></div>')
					.addClass('author')
					.html(author);
		
	var $date = $('<div></div>')
					.addClass('date')
					.html(date + '_');

	var $post_comment = $('<div></div>')
					.addClass('post_commnet');

	var $comment_link = $('<a></a>')
							.attr('href', config.url + 'Comments/' + blog_address + '/' + hash)
							.addClass('link')
							.html('Post New Comment');
	$post_comment.append($comment_link);

	/*    **** addd var $button = $('<button></button>')
					.html('Post New Comment')
					.click(function() {
					window.location = config.url + 'View/index/' + name;
					});*/
	var $br1 = $('<br>');
	var $br2 = $('<br>');

	var $postDiv = $('<div></div>')
					.addClass('post')
					//****** add $button
					.append($title, $br1, $content, $br2, $author, $date, $post_comment); 

	var $postContainer = $('<div></div>')
					.addClass('post-container')
					.append($postDiv);

	$('.post_div').append($postContainer);


	$comments.find('comment').each(function() {
		var $comment = $(this);

		//getting the values
		var author = $comment.find('author').html();
		var date = $comment.find('date').html();
		var content = $comment.find('content').html();

		//creating html divs and other elements
		var $author = $('<div></div>')
						.addClass('author')
						.html(author);

		var $date = $('<div></div>')
					.addClass('date')
					.html(date);

		var $content = $('<div></div>')
						.addClass('content')
						.html(content);

		/*    **** addd var $button = $('<button></button>')
						.html('Post New Comment')
						.click(function() {
							window.location = config.url + 'View/index/' + name;
						});*/

		var $br1 = $('<br>');
		var $br2 = $('<br>');
		var $commentsDiv = $('<div></div>')
						.addClass('comment')
						//****** add $button
						.append($author, $date, $br1, $content, $br2); 

		var $commentContainer = $('<div></div>')
						.addClass('comment-container')
						.append($commentsDiv);

		//console.log($commentContainer);
		$('.comments_div').append($commentContainer);
	});
})


