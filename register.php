<?php
include 'condb.php';

print_r($_POST);

// if form is empty do nothing otherwise attempt to register user.
if (!empty($_POST)){
	if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')){
	$stmt->bind_param('s',$_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	
	// if account already exists
	if ($stmt->num_rows > 0){
		echo 'account exists';
	} else {
		if($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?,?,?)')){
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $_POST['username'],$password, $_POST['email']);
            $stmt->execute();
            echo 'reg suc';
        }
	}
	$stmt->close();
	}
}
?>

<?php 
$pageTitle = "Register";
include 'header.php';
?>

<form action="register.php" method="post" id="register-form">
    <input type="text" class='username' name="username" placeholder="Username" required>
    <input type="password" class="password" name="password" placeholder="Password" required>
    <input type="email" id="email" name="email" placeholder="Email" required>
    <input type="submit" value="register" id='register'>
</form>

<?php include 'footer.php'?>