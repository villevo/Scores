

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
            <div class="col-md-8">

                <h1 class="page-header">
                    Tulosten syöttö

                </h1>

                <!-- tulosten lisäys-lomake -->
					<?php include '../include/addScore_stage1.php';?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Side Widget Well -->
					<?php include '../include/addScore_help.php';?>
                </div>

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
