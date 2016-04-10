<?php





   ob_start();
   session_start();
   

//user auth

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

								<title>Viikkis</title>


								<!-- Bootstrap Core CSS -->
								<link href="css/bootstrap.min.css" rel="stylesheet">

									<!-- Custom CSS -->
									<link href="css/custom.css" rel="stylesheet">

										<!-- Font Awesome CSS -->
										<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

											<style>

											</style>

										</head>

										<body>
											<div class=" container container-login">
												<div class="container form-signin">
													<p align="center"><h2> Viikkokisat</h2><br><img src="http://rolffarit.com/images/LOGOT/sitelogo.png" alt="Rolffarit" />
													</p>





													<?php
            $msg = '';
            $set_username = "rolf";
			$set_password = "rolf";
			
			
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['username'] == $set_username &&
				   $_POST['password'] == $set_password ) {
						$_SESSION['valid'] = true;
						$_SESSION['username'] = 'scores';
						$_SESSION['start'] = time(); // Taking now logged in time.  
						$_SESSION['expire'] = $_SESSION['start'] + (60 * 60 * 4); // Ending a session in 30 minutes from the starting time.
                  
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