
<?php require_once '../data/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

¨

				<?php include '../include/header.php';?>


    <!-- Page Content -->
    <div class="container">
	    <!-- Page Content styling -->
	<div class="container-inner">	

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Uusi kilpailu lisätty

                </h1>

                <!-- Kilpailun lisääminen-lomake-data-printti -->
					<?php include '../data/eventphp.php';?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Side Widget Well 
                <div class="well">
					<?php include '../include/addEvent_help.php';?>
                </div>
-->
            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
		
							<?php include '../include/footer.php';?>


    </div>
	</div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>
