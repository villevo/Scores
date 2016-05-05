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




// ***SET users who have accessto scores-app

//access level to weekly
//Set usernames who have access to weeklys
$settings_weekly_access = array("user1", "user2", "user3");

// Access level for lost and found
//set usernames who have access to lost-discs-form,
$settings_full_access = array("user4", "user5");


//****************

// Join accees levels to get all users who have access
$settings_normal_access= $result = array_unique(array_merge($settings_full_access, $settings_weekly_access));


?>