<?php

session_start();
if (!isset($_SESSION["loggedInUser"])) {
    header('Location: login.php');
}

require('connection.php');

if (isset($_POST['soortNaam'])) { // Magazijn toevoegen
    $sql = "INSERT INTO `soorten` (`naam`) VALUES (?) ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['soortNaam']]);
} else if (isset($_POST['wijzigNaam'])) { // Magazijn naam update
    $sql = "UPDATE `soorten` SET `naam` = ? WHERE `soorten`.`id` = ?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$_POST['verander'], $_POST['id']]);
} else if (isset($_POST['verwijder'])) { // Magazijn verwijderen
    $sql = "DELETE FROM `soorten` WHERE `soorten`.`id` = ?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$_POST['id']]);
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

    <title>Flower Inc. - Soorten</title>

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
                    <h1 class="h3 mb-4 text-gray-800">Soorten</h1>
                    
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Nieuw soort
                                </button>
                            </h2>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <form action="soorten.php" method="POST">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Naam</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="soortNaam">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Toevoegen</button>
                                </form>
                            </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Beheer soorten
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                <?php
                                    $data = $conn->query("SELECT * FROM `soorten`")->fetchAll();
                                    foreach ($data as $row) {
                                        echo '
                                        <form action="soorten.php" method="POST">
                                            <div class="form-inline">
                                            <input type="hidden" id="custId" name="id" value="' . $row['id'] . '"> 
                                                <input type="text" value="' . $row['naam'] . '" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="verander">
                                                <button type="submit" class="btn btn-primary btn-sm" style="margin-left: 6px;" name="wijzigNaam">Wijzig</button>
                                                <button type="submit" class="btn btn-danger btn-sm" style="margin-left: 6px;" name="verwijder">Verwijder</button>
                                            </div>
                                        </form><br/>';
                                    }
                                ?>
                                </div>
                            </div>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>