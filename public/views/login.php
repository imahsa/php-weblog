<div id="loginDiv">
	<div id = "all">
		<h1>Login Form: </h1>
		<div id="formDiv">
			<form  id="loginForm" novalidate method="post" action="<?php echo getenv('URL') ?>Login" >
				<br><br>
				Username: <input type="text" name="user_name"/>
				<br><br>
				Password: <input type="password" name="password" />
				<br><br>
				<div id="checkBox"><input type="checkbox" name="remember_me" value="remember" checked > Remember Me</div>
			</form>
   	 	</div>

    	<div id="otherLogin">
			<button  type="submit" form="loginForm" value="Submit">Login</button>
			<a href="/project/Register">Register Here</a>
		</div>
	</div>
</div>