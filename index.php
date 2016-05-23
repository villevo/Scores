<?php




//user auth
$scores_session_name = session_name("scores");
session_start();

if ((isset($_SESSION['username']) &&  $_SESSION['username'] != '')) {
	if (time() < $_SESSION['expire']) {		
		header ("Location: pages/scores.php");
	}	
}
	



?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-capable" content="yes">

			<title>Viikkis</title>


			<!-- Bootstrap Core CSS -->
			<link href="css/bootstrap.min.css" rel="stylesheet">
			<!-- Custom CSS -->
			<link href="css/custom.css" rel="stylesheet">
			<!-- Font Awesome CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class=" container container-login">
			<div class="container form-signin">
				<p align="center"><h2> Viikkokisat</h2><br><img src="http://rolffarit.com/images/LOGOT/sitelogo.png" alt="Rolffarit" />
				</p>

<?php
	$msg = '';
		 
	include './data/config.php';
		 
	if(!empty($_POST['username'])){
			 $username = mysqli_real_escape_string($link, $_POST['username']);
			 $password = mysqli_real_escape_string($link, $_POST['password']);
			 
		$lause = "SELECT Hash, Salt, Password FROM kisakone_User WHERE Username = '$username'";

			$tulos = mysqli_query($link, $lause);
			
			
			 
	if(mysqli_num_rows($tulos) == 1){
		//limit users 
		if (in_array($username,$settings_normal_access)) {
			
			   $right_username = $username;
			   $jono = mysqli_fetch_row($tulos);
			   $hash = $jono[0];
			   $salt = $jono[1];
			   $passu = $jono[2];
			   if (empty($hash))
				   $hash = "md5";
			   if ($hash == "md5")
				   $right_password = md5($password);
			   if ($hash == "crypt") {
				  $right_password = crypt($password, '$2y$10$' . $salt . '$');
			   }

			}
			}
			
			else{
			$msg = 'Väärin meni...';
			   $right_username = "";
			   $right_password = "";
			   
		}
		$tulos->close();
	}
		 

            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($passu)) {
               if ($username == $right_username &&
				   $passu == $right_password ) {
						$_SESSION['valid'] = true;
						$_SESSION['username'] = $username ;
						$_SESSION['start'] = time(); // Taking now logged in time.  
						$_SESSION['expire'] = $_SESSION['start'] + (60 * 60 * 24 * 12); // Ending a session in 12 days  from the starting time.
						if (in_array($username,$settings_full_access)) {
							$_SESSION['full_access'] =  1; // set full access for specified users
						}
						
						
						
				  header( 'Location: pages/scores.php' );
				  exit();
               }else {
                  $msg = 'Väärin meni...';
               }
            }
         ?>
			</div>
												<!-- /container -->
			<div>
				<form class="form-signin" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post">
						<h4 class="form-signin-heading"><?php echo $msg; ?></h4>
										<div style="display: flex;">
								
											<input type="text" class="form-control" name="username" placeholder="username" required autofocus>
										</div>
									</br>
								<div style="display: flex;">		
							<input type="password" class="form-control" name="password" placeholder="password" required>
						</div>														
					<button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login <i class="fa fa-sign-in"></i></button>
				</form>
			<p align="center"> Click here to clean <a href="pages/logout.php" tite="Logout">Session.</p>
		</div> 
	</div>
</body>
</html>


