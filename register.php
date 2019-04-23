<?php
if(isset($_POST['Register'])){
	// MD5 encryption
	$pass = md5($_POST["password"]);

	require_once 'database.php';
	require_once 'user.php';

	//echo "<h2>Add new User</h2>";
    $name = $_POST['uname'];
    $password = $pass;
    
    $db = Database::getDb();
    $u = new User();
    $my_data = $u->addUser($name, $password, $db);
    echo "<h2 class='green_mess'>Success!</h2>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <!-- BOOTSTRAP CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="conteiner  register-page">

        <!-- Login button -->
        <div class="row login">
            <div class="col-md-11" align="right">
                <form action="login.php" method="post">
                    <input type="hidden" name="hidden">
                    <input type="submit" name="login" value="Login" class="btn" />
                </form>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-offset-3" align="center">
                <h1>Register</h1>
                <form action="" name="register-form" method="post">
                    <label for="umame">User name</label>
                    <input type="text" name="uname" id="uname" required class="form-control">
                    <label for="pass">Password</label>
                    <input type="password" name="password" id="pass" required class="form-control">
                    <input type="reset" name="Reset" class="btn-danger btn">
                    <input type="submit" name="Register" class="btn-success btn">
                </form>
            </div>
        </div>
    </div>

</body>

</html>
