<div class="login-register">
	<a href="/project/Register" class="link">Register</a> / <a href="/project/Login" class="link"> Login</a>
</div><br><br>
<div id="hDiv">
	<h1>All Blogs:</h1>
</div>
<div class="filter">
		<form action="" id="category-filters">
			&nbsp; &nbsp; &nbsp; &nbsp; Category: 
				<select name="category"></select>
			<input type="submit" name="submit" value="Search" id="search">
		</form>	
</div>
<div class="blogs"></div>
<div style="display: none;" id="xml"><?php echo $xml ?></div>