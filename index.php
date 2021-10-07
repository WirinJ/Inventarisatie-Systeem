<?php

    session_start();
    if (!isset($_SESSION["loggedInUser"])) {
        header('Location: login.php');
    }

    require('connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Flower Inc. - Dashboard</title>

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <?php
                        $data = $conn->query("SELECT * FROM `soorten`")->fetchAll();
                        foreach ($data as $row) {
                            $data = $conn->query("SELECT Count(*) FROM `bloemen` WHERE soort_id = " . $row["id"])->fetch()[0];
                            if ($data < 1) {
                                echo '<div class="alert alert-danger" role="alert">
                                            Alle ' . $row["naam"] . ' zijn op!
                                      </div>';
                            }
                        }
                    ?>

                    <div class="card shadow mb-1">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Magazijnen</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample" style="">
                            <div class="card-body">
                                <?php
                                    $data = $conn->query("SELECT * FROM `magazijnen`")->fetchAll();
                                    foreach ($data as $row) {
                                        echo '
                                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                            <h1 class="h5 mb-0 text-gray-800">' . $row["naam"] . '</h1>
                                        </div>
                                        
                                        <div class="row">';
                                        
                                        $totaal_magazijn = $conn->query("SELECT COUNT(*) FROM `bloemen` WHERE `magazijn_id` = " . $row["id"])->fetch()[0];
                                        echo '
                                            <div class="col-xl-3 col-md-6 mb-4">
                                                <div class="card border-left-primary shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                    Totaal</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800">' . $totaal_magazijn . '</div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-warehouse fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ';

                                        $soorten_uniek = $conn->query("SELECT DISTINCT soort_id FROM bloemen")->fetchAll();
                                        foreach ($soorten_uniek as $uniek) {
                                            $soort_count = $conn->query("SELECT Count(*) FROM bloemen WHERE soort_id = " . $uniek["soort_id"] . " AND magazijn_id = " . $row["id"])->fetch()[0];
                                            $soort_naam = $conn->query("SELECT naam FROM soorten WHERE id = " . $uniek["soort_id"])->fetch()[0];

                                            echo '
                                                <div class="col-xl-3 col-md-6 mb-4">
                                                    <div class="card border-left-warning shadow h-100 py-2">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col mr-2">
                                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                                    ' . $soort_naam . '</div>
                                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">' . $soort_count . '</div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <i class="fas fa-equals fa-2x text-gray-300"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                        echo '</div>';
                                    } 
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample2">
                            <h6 class="m-0 font-weight-bold text-primary">Bloemen</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample2" style="">
                            <div class="card-body">
                                <?php
                                    $data = $conn->query("SELECT * FROM `soorten`")->fetchAll();
                                    foreach ($data as $row) {
                                        echo '
                                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                            <h1 class="h5 mb-0 text-gray-800">' . $row["naam"] . '</h1>
                                        </div>
                                        
                                        <div class="row">';
                                        
                                        $totaal_bloem = $conn->query("SELECT Count(*) FROM `bloemen` WHERE soort_id = " . $row["id"])->fetch()[0];
                                        echo '
                                            <div class="col-xl-3 col-md-6 mb-4">
                                                <div class="card border-left-primary shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                    Totaal</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800">' . $totaal_bloem . '</div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-warehouse fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ';

                                        $magazijn_namen = $conn->query("SELECT * FROM magazijnen")->fetchAll();
                                        foreach ($magazijn_namen as $magazijn) {
                                            $magazijn_count = $conn->query("SELECT Count(*) FROM bloemen WHERE soort_id = " . $row["id"] . " AND magazijn_id = " . $magazijn["id"])->fetch()[0];

                                            echo '
                                                <div class="col-xl-3 col-md-6 mb-4">
                                                    <div class="card border-left-warning shadow h-100 py-2">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col mr-2">
                                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                                    ' . $magazijn["naam"] . '</div>
                                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">' . $magazijn_count . '</div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <i class="fas fa-equals fa-2x text-gray-300"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                        echo '</div>';
                                    } 
                                ?>
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