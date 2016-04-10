

<?php require_once '../data/config.php'; ?>
<!DOCTYPE html>
<html lang="en">



						<?php include '../include/header.php';?>


    <!-- Page Content -->
    <div class="container">
	    <!-- Page Content styling -->
	<div class="container-inner">	

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-9">

                <h1 class="page-header">
                    Löytökiekkojen syöttö

                </h1>

                <!-- tulosten lisäys-lomake -->
					<?php include '../include/losted.php';?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">
                <!-- Side Widget Well -->
					<?php include '../include/losted_help.php';?>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

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
