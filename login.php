<?php
include 'condb.php';

if (!empty($_POST)){
// error when a field is empty
if (!isset($_POST['username'], $_POST['password'])){
	exit('Please fill both the username and password fields!');
}

// prep sql
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')){
	$stmt->bind_param('s',$_POST['username']);
	$stmt->execute();
	// store result
	$stmt->store_result();
	

	if ($stmt->num_rows > 0){
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		// acc exists; verify pass now
		if (password_verify($_POST['password'], $password)){
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username'];
			$_SESSION['id'] = $id;
			header('Location: home.php');
		} else {
			$loginError = 'The password you have entered is incorrect.';
		}
	} else {
		$loginError =  'No account exists with this username.';
	}
	$stmt->close();
}}
?>

<?php $pageTitle = "Login";
include 'header.php';
?>

<div id="login-form">

    <h1>Login</h1>
    <i class="fas fa-user-circle"></i>
    <form action="login.php" method="post">
        <p class='error-msg'><?php if (isset($loginError)){echo $loginError;}?></p>
        <input type="text" class="username" name="username" placeholder="Username" required>
        <input type="password" class="password" name="password" placeholder="Password" required>
        <input type="submit" value="login" id="login">
    </form>
    <div>
        <p>Forgot password</p>
        <p>Remember me?</p>
    </div>

</div>

<?php
include 'footer.php';
?>