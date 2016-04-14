<?php
//user logout
$scores_session_name = session_name("scores");
session_start();
   unset($_SESSION["valid"]);
   unset($_SESSION["username"]);
   unset($_SESSION["start"]);
   unset($_SESSION["expire"]);
   unset($_SESSION["full_access"]);

      echo "Kirjauduit ulos.";
	  
      header('Refresh: 1; URL = ../index.php');
?>