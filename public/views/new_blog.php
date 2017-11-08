<style type="text/css"> 
	#des {overflow: scroll;}
</style>
<div id="newBlogDiv">
	<div id="all">
		<div id="newBlogFormDiv">
			<h1>New Blog: </h1>
			<form  id="newBlogForm" novalidate method="post" enctype="multipart/form-data" action="<?php echo getenv('URL') ?>New_Blog"><br><br>
			Blog Name: <input type="text" name="blogName"/><br><br>
			Blog Address: http:localhost/ <input type="text" name="blogAddress" /><br><br>
			<div style="display: none;" id="xml"><?php echo $xml ?></div>
			Category: <select name="category"></select>
			<br><br>
			Blog Header: <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*"><br><br>
			</form>
			Description: <br> <textarea name="description"  form="newBlogForm" id="des" rows="10" cols="30">
			</textarea>	<br></br>
		</div>
		<div id="bDiv">
		    <button  type="submit" form="newBlogForm" value="Submit">Create</button>
		</div>
	</div>
</div>