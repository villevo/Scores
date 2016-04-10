
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
                    Löytökiekot lisätty

                </h1>

                <!-- KLöytökiekko-data-printti -->
					<?php include '../data/lostedphp.php';?>

            </div>

            <!-- Blog Sidebar Widgets Column  poistettu
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
