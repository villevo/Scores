<?PHP

//user auth
session_start();
if (!(isset( $_SESSION['username']) &&  $_SESSION['username'] != '')) {
	header ("Location: ../index.php");
}
if (time() > $_SESSION['expire']) {
            session_destroy();
			header ("Location: ../index.php");
}			

?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="mobile-web-app-capable" content="yes">

    <title>Viikkis</title>

		<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/custom.css" rel="stylesheet">
		<!-- checkbox css		-->
	
	    <script src="../js/jquery.js">
		
		<script src="../js/bootstrap.js"></script>	
		
	<script>


		

			
		$(document).ready(function(){
			$("button").click(function(){
				$("div.code").slideToggle("code-show");
				});
			});	
	</script>
	
	<?php 

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}

?>


</head>

<body>

<nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
					<span class="icon-bar"></span>                    
                </button>
            <!--    <a class="navbar-brand" href="../pages/Scores.php">Scores</a> -->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
					<li <?=echoActiveClassIfRequestMatches("scores")?>><a href="../pages/scores.php">
						<i class="fa fa-calculator"></i> Tulosten syöttö</a>
					</li>

					<li <?=echoActiveClassIfRequestMatches("event")?>><a href="../pages/event.php">
						<i class="fa fa-calendar-plus-o"></i> Lisää kilpailu</a>
					</li>

<?php	
/*					
<li <?=echoActiveClassIfRequestMatches("event")?>><a href='../pages/losted.php'>
						<i class='fa fa-life-ring'></i> Löytökiekot</a>
					</li>	

*/

if (isset($_SESSION['full_access']) AND $_SESSION['full_access'] == 1 ){
			echo"
				<li ";
					echoActiveClassIfRequestMatches("losted");
				
				
			echo	"><a href='../pages/losted.php'>
						<i class='fa fa-life-ring'></i> Löytökiekot</a>
					</li>	
			";
	}
	?>
									
					
	
					<li class="menu_divider_mobile">
					<li>
					

                </ul>
				
				
				 <ul class="nav navbar-nav navbar-right">
				 					<li><a href="../../kisakone" target="_blank">
						<i class="fa fa-trophy"></i> Kisakone</a>
					</li>

					<li><a href="http://www.rolffarit.com"  target="_blank">
						<i class="fa fa-chrome"></i> Rolffarit.com</a>
					</li>	
					
					<li><a class="navbar-menu-item"  href="../pages/logout.php">
						<i class="fa fa-sign-out"></i></i> Log-Out</a>
					</li>
				</ul>
			
			
            </div>
            <!-- /.navbar-collapse -->
        </div>
</nav>      