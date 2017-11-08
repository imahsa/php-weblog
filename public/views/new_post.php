<style type="text/css"> 
	#content {overflow: scroll;}
</style>
<div id="newPostDiv">
	<div id="all">
		<div id="newPostFormDiv">
			<h1>Create New Post: </h1>
			<form  id="newPostForm" novalidate method="post" action="<?php echo getenv('URL') ?>New_Post/<?php echo $blog_address ?>"><br><br>
		    Title: <input type="text" name="title"/><br><br>
		    Content: <textarea name="content"  form="newPostForm" id="content" rows="10" cols="50">
		    </textarea>	<br></br>
		</div>
		<div id="bDiv">
		    <button  type="submit" form="newPostForm" value="Submit">Post</button>
		</div>
	</div>
</div>