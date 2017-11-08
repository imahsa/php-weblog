<div id="regDiv">
	<div id="all">
		<h1>Registration Form: </h1>
		<div id="formDiv">
			<form  id="registerForm" novalidate method="post" enctype="multipart/form-data" action="<?php echo getenv('URL') ?>Register" ><br><br>
		<!--	<div id="vertical">-->
					<div id="texts">
						Username: <br><br> 
						Password: <br><br> 
						Name: <br><br> 
						Birthday: <br><br> 
						Avatar: <br><br> 
					</div>
					<div id="inputs">
						<input type="text" name="userName"/><br><br>
			       		<input type="password" name="pass" /><br><br>
			      		<input type="text" name="name"/><br><br>
			        	<input type="date" name="bday"/><br><br>
			        	<input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
					</div>
		<!--	</div>-->
		     <!-- Username: <input type="text" name="userName"/><br><br>
		      Password: <input type="password" name="pass" /><br><br>
		      Name: <input type="text" name="name"/><br><br>
		      Birthday: <input type="date" name="bday"/><br><br>
		      Avatar: <input type="file" name="pic" accept="image/*"><br><br>-->
	    	</form>
		    <div id="captchaDiv">
		    </div>
			<h6>*All Fields are Required</h6>
		</div>
	</div>
</div>

<div id="otherReg">
	<button  type="submit" form="registerForm" value="Submit">Register</button>
	<a href="/project/Login">Already registered? Login</a>
</div>