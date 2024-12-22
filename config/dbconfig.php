<?php 

    
    $DBconnect = mysqli_connect('localhost', 'root', '', 'magicuisine');
    
    if (!$DBconnect) {
        die ("Connection to Database failed: " . mysqli_connect_error($DBconnect));
    }


?>