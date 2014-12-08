<?php
require_once('common.php');

$error = '0';

if (isset($_POST['submitBtn'])){
	// Get user input
	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
        
	// Try to login the user
	$error = loginUser($username,$password);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
   <title>Login - Robert S Dixon</title>
   <link href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<br>
<br>
<center><img src="../images/logo.png" height="100" width="800"></center>
<br>
<br>
    <div id="main">
<?php if ($error != '') {?>
      <div class="caption">Members Area Login</div>
      <div id="icon">&nbsp;</div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
        <table width="100%">
          <tr><td>Username:</td><td> <input class="text" name="username" type="text"  /></td></tr>
          <tr><td>Password:</td><td> <input class="text" name="password" type="password" /></td></tr>
          <tr><td colspan="2" align="center"><input class="text" type="submit" name="submitBtn" value="Login" /></td></tr>
        </table>  
      </form>
      
      &nbsp;&nbsp;&nbsp;&nbsp;<a href="register.php">Register</a>
      
<?php 
}   
    if (isset($_POST['submitBtn'])){

?>
      <div class="caption">Login Result:</div>
      <div id="icon2">&nbsp;</div>
      <div id="result">
        <table width="100%"><tr><td><br/>
<?php
	if ($error == '') {
		echo "Welcome $username! <br/>You are logged in!<br/><br/>";
		echo '<a href="index.html">Go to Members Area &raquo;</a>';
	}
	else echo $error;

?>
		<br/><br/><br/></td></tr></table>
	</div>
<?php            
    }
?>
	<div id="source">Copyright &copy; Robert S Dixon 2014</div>
    </div>
</body>
</html>
<noscript>
