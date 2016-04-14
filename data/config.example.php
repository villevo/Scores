<?php
/**
* Config file for Scores
**/




/**
* Connect to database
**/
$link = mysqli_connect("localhost", "my_user", "my_password", "my_db");
 
// Check connection
if($link === false){
    die("<br><br>	ERROR: <br> config.php:  tietokanta yhteys munillaan." . mysqli_connect_error());
}




//Set usernames who have access to weeklys
$settings_normal_access = array("user1", "user2", "user3");

//set usernames who have access to lost-discs-form, user must exist in upper array
$settings_full_access = array("user1", "user2");









?>