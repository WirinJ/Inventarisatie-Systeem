<?php

session_start();
if (!isset($_SESSION["loggedInUser"])) {
    header('Location: login.php');
}

require('connection.php');

if (isset($_POST['verwijder'])) { // Magazijn verwijderen
    $sql = "DELETE FROM `bloemen` WHERE `bloemen`.`id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['id']]);
} else if (isset($_POST['gekozenMag'])) { // Bloem toevoegen
    $sql = "INSERT INTO `bloemen` (`naam`, `magazijn_id`, `soort_id`) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['bloemNaam'], $_POST['gekozenMag'], $_POST['gekozenSoort']]);
} else if (isset($_POST['bloemVerander'])) { // Magazijn naam update
    $sql = "UPDATE `bloemen` SET `naam` = ?, `soort_id` = ?, `magazijn_id` = ? WHERE `bloemen`.`id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['bloemVerander'], $_POST['gekozenSoort'], $_POST['magVerander'], $_POST['id']]);
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

    <title>Flower Inc. - Bloemen</title>

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
                    <h1 class="h3 mb-4 text-gray-800">Bloemen</h1>
                    
                    <div class="accordion" id="accordionExample">

                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Nieuw bloem
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form action="bloemen.php" method="POST">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Naam</label>
                                            <input type="text" class="form-control" name="bloemNaam">
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="exampleInputEmail1">Afbeelding</label>
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                        </div> -->
                                        <label for="magKiezen">Magazijn</label>
                                        <div class="form-group">
                                            <select id="magKiezen" class="form-select" name="gekozenMag">
                                                <?php
                                                    $data = $conn->query("SELECT * FROM `magazijnen`")->fetchAll();
                                                    foreach ($data as $row) {
                                                        echo '<option value="' . $row["id"] . '">' . $row["naam"] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <label for="soortKiezen">Soort</label>
                                        <div class="form-group">
                                            <select id="soortKiezen" class="form-select" name="gekozenSoort">
                                                <?php
                                                    $data = $conn->query("SELECT * FROM `soorten`")->fetchAll();
                                                    foreach ($data as $row) {
                                                        echo '<option value="' . $row["id"] . '">' . $row["naam"] . '</option>';
                                                    }
                                                ?>
                                            </select>
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
                                    Beheer bloemen
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">

                                    <div id="accordion2">
                                        <?php
                                            $data = $conn->query("SELECT * FROM `magazijnen`")->fetchAll();
                                            foreach ($data as $row) {
                                                echo '
                                                <div class="card">
                                                    <div class="card-header" id="heading' . $row['id'] . '">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse' . $row['id'] . '" aria-expanded="true" aria-controls="collapse' . $row['id'] . '">
                                                            ' . $row['naam'] . '
                                                            </button>
                                                        </h5>
                                                    </div>

                                                    <div id="collapse' . $row['id'] . '" class="collapse" aria-labelledby="heading' . $row['id'] . '" data-parent="#accordion2">
                                                        <div class="card-body">
                                                ';

                                                $bloemen = $conn->query("SELECT * FROM `bloemen` WHERE `magazijn_id` = " . $row["id"])->fetchAll();
                                                echo '<div id="accordion3">';
                                                
                                                foreach ($bloemen as $bloem) {
                                                    echo '
                                                        <div class="card">
                                                            <div class="card-header" id="headin' . $bloem['id'] . '">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collaps' . $bloem['id'] . '" aria-expanded="true" aria-controls="collaps' . $bloem['id'] . '">
                                                                    ' . $bloem["id"] . ' - ' . $bloem["naam"] . '
                                                                    </button>
                                                                </h5>
                                                            </div>

                                                            <div id="collaps' . $bloem['id'] . '" class="collapse" aria-labelledby="headin' . $bloem['id'] . '" data-parent="#accordion3">
                                                                <div class="card-body">
                                                                <form action="bloemen.php" method="POST">
                                                                    <input type="hidden" id="custId" name="id" value="' . $bloem['id'] . '">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Naam</label>
                                                                        <input type="text" class="form-control" id="exampleInputEmail1" value="' . $bloem['naam'] . '" name="bloemVerander">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Magazijn</label>
                                                                        <select id="magKiezen" class="form-select" name="magVerander">';
                                                                        
                                                                        $data = $conn->query("SELECT * FROM `magazijnen`")->fetchAll();
                                                                        foreach ($data as $row) {
                                                                            echo '<option selected value="' . $row["id"] . '">' . $row["naam"] . '</option>';
                                                                        };

                                                                    echo '</select>
                                                                    </div>
                                                                    
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="soortKiezen">Soort</label>
                                                                        <select id="soortKiezen" class="form-select" name="gekozenSoort"> ';
                                                                            $data = $conn->query("SELECT * FROM `soorten`")->fetchAll();
                                                                            foreach ($data as $row) {
                                                                                echo '<option selected value="' . $row["id"] . '">' . $row["naam"] . '</option>';
                                                                            }
                                                                            echo '
                                                                        </select>
                                                                    </div>
                                                                    
                                                                    <button type="submit" class="btn btn-primary">Wijzig</button>
                                                                    <button type="submit" class="btn btn-danger" name="verwijder">Verwijder</button>
                                                              </form>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }

                                                echo '</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                ';
                                            };
                                        ?>
                                    </div>

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