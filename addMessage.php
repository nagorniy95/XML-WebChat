<?php
session_start();

$conversation = simplexml_load_file("chatRoomsXML/chatRoom" . $_GET['id'] . ".xml");


// ============================================================ Add new message
    $newmessage = $conversation->chatroom->addChild('message');
    $newmessage->addAttribute('messageId', count($conversation->chatroom->message) + 1 );
    $newmessage->addAttribute('date', date("Y-m-d"));
    $newmessage->addAttribute('time', date("H:i:s"));
    $newmessage->addChild('from', $_SESSION['givenName']);
    $newmessage->addChild('text', $_POST['message']);

    // ======================================================== Save new message to XML file
    $conversation->saveXML("chatRoomsXML/chatRoom" .  $_GET['id'] . ".xml");