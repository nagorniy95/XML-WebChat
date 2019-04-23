<?php
session_start();

include 'chatroom.php';  

// $conversation = simplexml_load_file("conversation.xml");
$rooms = new SimpleXMLElement($xmlstr);
// ===================================================== CHECK FOR ACCESS TOKEN
	if (!isset($_SESSION['access_token'])) {
		header('Location: login.php');
		exit();
	}

// ===================================================== LOG OUT 
	 if (isset($_POST['logout'])) {
    	require_once "config.php";
		unset($_SESSION['access_token']);
		$gClient->revokeToken();
		session_destroy();
		header('Location: login.php');
		exit();
	 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery.min.js"></script>
    <title>User:
        <?php if(isset($_SESSION['givenName'])){echo $_SESSION['givenName'];} ?>
    </title>
    <!-- BOOTSTRAP CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container listRooms" align="center">

        <!-- Welcome back message -->
        <div class="row welcome-mess">
            <h1 class="col-md-12">Welcome back
                <?php if(isset($_SESSION['givenName'])){ echo $_SESSION['givenName'];} ?>!</h1>
        </div>

        <!-- User avatar for google login -->
        <div class="row">
            <div class="col-md-12">
                <?php if(isset($_SESSION['picture'])){
					$picture = $_SESSION['picture'];
					echo '<img class="avatar" src="' . $picture . ' ">';
				} ?>
            </div>
            <h2 class="col-md-12">Chats</h2>
        </div>

        <!-- The list of chat rooms -->
        <ul class="col-md-8">
            <?php foreach ($rooms->xpath('//chatroom') as $chatroom){ ?>
            <div class="chatBlock">
                <a class="roomName" href="listConversation.php?id=<?= $chatroom['chatRoomId'] ?>&user=<?= $_SESSION['givenName'] ?>">
                    <li>
                        <?= $chatroom->name ?>
                    </li>
                </a>
                <p>
                    <?php echo 'Chat room &#35; ' . $chatroom['chatRoomId'] . '<br />'; ?>
                </p>
            </div>
            <?php } ?>
        </ul>

        <!--  LOG OUT button  -->
        <form action="#" method="post">
            <input type="submit" name="logout" value="Log out" class="btn btn-danger" />
        </form>
    </div>
    <footer id=footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" align="center">
                    <p id="madeby">&copy;Artem Nahornyi
                        <?php echo date("Y"); ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
