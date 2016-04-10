<?php
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   

      echo "Kirjauduit ulos.";
	  
      header('Refresh: 1; URL = ../index.php');
?>