<?php
  // ===================================== google authorization
  require_once ("config.php");
  
  // if user loged in, we will send him/her to room page
  if (isset($_SESSION['access_token'])) {
    header('Location: listRooms.php');
    exit();
  }

  $loginURL = $gClient->createAuthUrl();
// =============================================================

$users = simplexml_load_file("user.xml");

// Add new user to XML file
if(isset($_POST['submit'])){
    $uname = $_POST['uname'];
    
    $newuser = $users->addChild('user');
    $newuser->addAttribute('userId', count($users->user) + 1 ); // to display userId; use -> count()
    $newuser->addChild('name', $uname);
    // Save new message to XML file
    $users->saveXML("user.xml");
}

// ========================================== Regular Login
if (isset($_POST['submit'])){
    require_once 'database.php';
    require_once 'user.php';

    // get value from user
    $password = md5($_POST["password"]);
    $uname = $_POST['uname'];

    //echo "Uname is set!";
    // set useer name for a session
    $_SESSION['givenName'] = $_POST['uname'];

    $db = Database::getDb();
    $u = new User();
    $my_data = $u->getUser($uname, $password, $db);

    if($my_data > 1) {
      // this part is to make it work with google, because we need to create access token to get access to listRooms page. Otherwvise user will be redirect to login page
      $_SESSION['access_token'] = true;
      // redirect to listRooms
      header("Location: listRooms.php");
      die();
    } else {
      echo "<h2 class='red_mess'>Username or Password is wrong!</h2>";
    }


}else{
    //echo "<p>Please login to continue</p>";
}
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- BOOTSTRAP CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container login-page">

        <!-- Register button -->
        <div class="row register">
            <div class="col-md-12" align="right">
                <form action="register.php" method="post">
                    <input type="hidden" name="hidden">
                    <input type="submit" name="register" value="Register" class="btn" />
                </form>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-offset-3" align="center">

                <img src="img/user.png" class="user-login-img">
                <form action="#" method="post">
                    <!-- Regular Login -->
                    <input type="text" id="uname" placeholder="Username..." name="uname" required class="form-control" />
                    <input type="password" id="password" placeholder="Password..." name="password" required class="form-control">
                    <input type="submit" name="submit" value="Login" class="btn btn-primary" />
                    <!-- Google Login Button -->
                    <input type="button" onclick="window.location = '<?php echo $loginURL ?>'" name="submit" value="Log In Width Google" class="btn btn-danger" />
                </form>

            </div>
        </div>
    </div>

</body>

</html>
