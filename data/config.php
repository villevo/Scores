<?php
$link = mysqli_connect("localhost", "form", "form", "form");
 
// Check connection
if($link === false){
    die("<br><br>	ERROR: <br> config.php:  tietokanta yhteys munillaan." . mysqli_connect_error());
}
?>