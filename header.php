<!DOCTYPE html>
<?php
session_start();

mysql_connect($mysql_host, $mysql_username, $mysql_password) or die("MySQL error: " . mysql_error());
mysql_select_db("bh2017") or die("MySQL error: " . mysql_error());
?>  
<html>

    <head>
        
        <link rel="stylesheet" type="text/css" href="style.css">
        
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    </head>

    <body>
        <top class="topcontainer">
        
            <left class="leftcontainer">
            
                <div id="support" class="button">
                    <p>Support a Classroom</p>
                </div>
            </left>
            
            <name>
                TITLE OF APP
            </name>
            
            <right class="rightcontainer">
            
                <div id="login" class="button">
                    <p>Login</p>
                </div>
                
                <div id="signup" class="button">
                    <p>Sign Up</p>
                </div>
            </right>
        </top>