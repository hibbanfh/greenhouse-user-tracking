<?php 
$db = mysqli_connect("localhost", "raspberry", "dsspadi", "greenhouse");
if ($db-> connect_error) {
            die("Connection Failed: ". $db-> connect_error);
        }
?>
