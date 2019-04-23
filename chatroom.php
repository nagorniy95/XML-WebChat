<?php
$xmlstr = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<rooms>
    <chatroom chatRoomId="1" date="2019-02-01" time="13:00:00">
        <name>Optic</name>
        <description>Fun group</description>
        <logo name="logo">LogoImage.jpg</logo>
        <users>
            <nickName admin="true">Alex</nickName>
            <nickName admin="false">Michel</nickName>
            <nickName admin="false">Ann</nickName>
        </users>
    </chatroom>
    <chatroom chatRoomId="2" date="2019-02-02" time="14:00:00">
        <name>Tee-blog</name>
        <description>new ideas</description>
        <logo name="logo2">LogoImage2.jpg</logo>
        <users>
            <nickName admin="true">Margo</nickName>
            <nickName admin="false">Stiven</nickName>
            <nickName admin="false">Nina</nickName>
        </users>
    </chatroom>
    <chatroom chatRoomId="3" date="2019-02-02" time="15:00:00">
        <name>StatupGeek</name>
        <description>Lets talk about our project</description>
        <logo name="logo3">LogoImage3.jpg</logo>
        <users>
            <nickName admin="true">Alex</nickName>
            <nickName admin="true">Michel</nickName>
            <nickName admin="false">Ann</nickName>
            <nickName admin="false">Alenn</nickName>
            <nickName admin="false">Micha</nickName>
            <nickName admin="false">Omar</nickName>
        </users>
    </chatroom>
</rooms>
XML;
?>
