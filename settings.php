<?php

	session_start();
	if (!isset($_SESSION["loggedInUser"])) {
        header('Location: login.php');
	}

    require('connection.php');
    if (isset($_POST['nieuwWW'])) {

        if ($_POST['nieuwWW'] != $_POST['herhaalWW']) {
            echo '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                De ingevoerde wachtwoorden komen niet overeen, probeer het opnieuw!
            </div>';
        } else {
            $sql = "UPDATE `gebruikers` SET `password` = ? WHERE `gebruikers`.`id` = 1 ";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$_POST['nieuwWW']]);

            header("Location: logout.php"); 
        }

    }


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Flower Inc. - Wachtwoord wijzigen</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?= file_get_contents("html/sidebar.html"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?= file_get_contents('html/topbar.html'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Settings</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            Wachtwoord wijzigen
                        </div>
                        <div class="card-body">
                            <form action="settings.php" method="POST">
                                <div class="form-group">
                                    <label>Nieuw wachtwoord</label>
                                    <input class="form-control" type="password" name="nieuwWW">
                                </div>

                                <div class="form-group">
                                    <label>Herhaal nieuw wachtwoord</label>
                                    <input class="form-control" type="password" name="herhaalWW">
                                </div>

                                <a class="btn btn-light btn-icon-split">
                                    <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <input type="submit" class="btn btn-light btn-icon-split text" value="Wijzig wachtwoord">
                                </a>

                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?= file_get_contents('html/footer.html'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>