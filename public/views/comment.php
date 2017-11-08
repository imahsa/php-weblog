<style type="text/css"> 
	#comment {overflow: scroll;}
</style>
<div id="commentPage">
	<div class="header">
		
	</div>
	<div id="commentDiv">
		<h1>Post a Comment: </h1>
		<div id= "all">
			<div id="commentFormDiv">
				<form  id="commentForm" novalidate method="post" action="<?php echo getenv('URL') ?>Comments/<?php echo $blog_address ?>/<?php echo $post_hash ?>"><br><br>
				Name: <input type="text" name="name"/><br><br>
				Comment: <br> <textarea name="content"  form="commentForm" id="comment" rows="10" cols="40">
				</textarea>	<br></br>
				</form>
				<div id="bDiv">
					<button  type="submit" form="commentForm" value="Submit">Post</button>
				</div>
		    </div>
		<div>
	</div>
</div>