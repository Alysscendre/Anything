<?php
require('config.php');
session_start();

if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($conn, $username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `users` WHERE username='$username' and password='".hash('sha256', $password)."'";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

	$rows = mysqli_num_rows($result);
	if($rows==1){
	    $_SESSION['username'] = $username;
	    header("Location: index.php");
	}else{
		$message = "Incorrect username or password.";
	}
}
?>


<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Login</title>
        <link rel="stylesheet" href="login.css" type="text/css">
  <script src="script.js"></script>
</head>
<body>      



<div class="navig">
        <nav>
            <a href="index.html"><li>Home</li></a>
        </nav>
</div>


             




        <form class="box" action="" method="post" name="login">
            <h1 class="box-title">Connexion</h1>

    <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
    <input type="password" class="box-input" name="password" placeholder="Mot de passe">
    <input type="submit" value="Connexion " name="submit" class="box-button">
        <p class="box-register">New here ? <a href="register.php">Register</a></p>

       

        <?php if (! empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>
</form>

           





<!-- <footer><nav>
    <a href="index.php"><li>Home</li></a><li id="services">Services</li><li>Contact</li>
 </nav></footer> -->
</body>
</html>