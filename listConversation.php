<?php
session_start();

include 'chatroom.php';  

// $messages = $_POST['messages'];

$rooms = new SimpleXMLElement($xmlstr);
//$conversation = new  SimpleXMLElement($xmlstrC);

// =========================================================== To find correct chat room
if($_GET['id'] == 1){
    $conversation = simplexml_load_file("chatRoomsXML/chatRoom1.xml");
} elseif($_GET['id'] == 2){
    $conversation = simplexml_load_file("chatRoomsXML/chatRoom2.xml");
} elseif($_GET['id'] == 3){
    $conversation = simplexml_load_file("chatRoomsXML/chatRoom3.xml");
} else{
    echo "<h1 class='col-md-12' align='center'>Sorry, this chat is not working!</h1>";
    die();
}

// ============================================================ Add new message
if(isset($_POST['message'])){
    $newmessage = $conversation->chatroom->addChild('message');
    // to display messageId; use -> count()
    $newmessage->addAttribute('messageId', count($conversation->chatroom->message) + 1 );
    $newmessage->addAttribute('date', date("Y-m-d"));
    $newmessage->addAttribute('time', date("H:i:s"));
    $newmessage->addChild('from', $_SESSION['givenName']);
    $newmessage->addChild('text', $_POST['message']);

    // ======================================================== Save new message to XML file
    if($_GET['id'] == 1){
    $conversation->saveXML("chatRoomsXML/chatRoom1.xml");
    } elseif($_GET['id'] == 2){
        $conversation->saveXML("chatRoomsXML/chatRoom2.xml");
    } elseif($_GET['id'] == 3){
        $conversation->saveXML("chatRoomsXML/chatRoom3.xml");
    } else{
        echo "<h1 class='col-md-12' align='center'>Sorry, this chat is not working!</h1>";
        die();
    }
}

// ============================================================ Log OUT
if (isset($_POST['logout'])){
    // destroy session
    unset($_SESSION['user']);
    $_SESSION = [];
    session_destroy();
    header("Location: login.php");
    die();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $rooms->chatroom->name ?>
    </title>
    <!-- BOOTSTRAP CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
</head>

<body>

    <div class="container ">
        <!-- ============================= LOG OUT  button ============================= -->
        <div class="row register">
            <div class="col-md-12" align="right">
                <form action="#" method="post" id="logOutForm">
                    <input type="submit" name="logout" value="Log Out" class="btn" />
                </form>
            </div>
        </div>

        <div class="col-md-9 listChat">
            <!-- Chat number -->
            <h1>Chat room &#35;
                <?php echo $_GET["id"] ?>
            </h1>

            <!-- =========================== Chat starts here =========================== -->
             <div class="chatMess" id="chatMess">
                <ul>
                    <?php foreach ($conversation->xpath('//message') as $conversation){ 
                    if($conversation->from == $_SESSION['givenName']){?>
                        <li class="right">From:<span class="bold">
                                <?php echo $conversation->from ?> </span>
                        </li>
                        <div class="clear"></div>

                        <div class="message right">
                            <?= $conversation->text ?>
                            <div class="date-time">
                                <?= "Date: " .  $conversation['date'] . " Time: " . $conversation['time'] ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    <?php }else{ ?>
                        <li class="">From:<span class="bold">
                                <?php echo $conversation->from ?> </span>
                        </li>
                        <div class="clear"></div>

                        <div class="message">
                            <?= $conversation->text ?>
                            <div class="date-time">
                                <?= "Date: " .  $conversation['date'] . " Time: " . $conversation['time'] ?>
                            </div>
                        </div>
                        <div class="clear"></div>

                    <?php } ?>
                    <?php } ?>
                </ul>
             </div>
            <!-- =============================== Add new message =============================== -->
            <form method="post" action="" id="newmessage">
                <div class="row" align="center">
                    <input type="text" placeholder="Enter message" name="message" required id="message" class="form-control col-md-10" maxlength="60" onfocus="this.value=''">
                    <button type="submit" id="submit" class="btn btn-primary col-md-2">Send</button>
                </div>
            </form>

        </div>
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
    <script type="text/javascript" src="js/ajax.js"></script>
</body>

</html>
