<?php
require "connection.php";
session_start();
if (!empty($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Select Class</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="pictures/logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    </head>

    <body class="profile">

        <div class="container-fluid">
            <div class="col-12 mt-5 p-3">
                <div class="row">
                    <?php

                    $r = Database::search("select * from student_has_class where student_id='" . $_SESSION["u"]["id"] . "'");
                    $n = $r->num_rows;
                    if ($n > 0) {

                        for ($i = 0; $i < $n; $i++) {
                            $rs = $r->fetch_assoc();

                            $f = Database::search("select * from teacher_has_class where id='" . $rs["class_id"] . "'");
                            $nf = $f->num_rows;

                            $fs = $f->fetch_assoc();

                            $r1 = Database::search("select * from grade where id='" . $fs["grade_id"] . "'");
                            $r2 = Database::search("select * from subject where id='" . $fs["subject_id"] . "'");
                            $r3 = Database::search("select * from medium where id='" . $fs["medium_id"] . "'");

                            $rs1 = $r1->fetch_assoc();
                            $rs2 = $r2->fetch_assoc();
                            $rs3 = $r3->fetch_assoc();

                    ?>

                            <div class="col-lg-3 p-3 mt-2 mb-2 border bordr-2 rounded col-10 offset-1 offset-lg-0">
                                <div class="col-12 text-center">
                                    <span>Go to <?= $rs1["name"] ?> <?= $rs2["name"] ?> Class</span><br/>
                                    <span class="text-danger"><?=$rs3["name"]?> Medium</span>
                                </div>

                                <?php
                                if ($rs["status"] == "1") {
                                ?>
                                    <div class="col-12 text-center mt-1">
                                        <a href="studentClass.php?gi=<?= $fs["grade_id"] ?>&&mi=<?= $fs["medium_id"] ?>&&si=<?= $fs["subject_id"] ?>" class="btn btn-primary">Go to Class</a>
                                    </div>
                                <?php
                                } else {
                                ?>

                                    <div class="col-12 text-center mt-1">
                                        <a href="paymentProcess.php?ci=<?= $rs["class_id"] ?>&ui=<?= $_SESSION["u"]["id"] ?>" class="btn btn-primary">Make sure to do monthly payment</a>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>

                    <?php
                        }
                    }else{
                        ?>
                        <div class="col-10 offset-1 text-center">
                            <span class="fs-3 text-black-50">No Cources Selected</span>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>

    </body>

    </html>
<?php
} else {
?>
    <script>
        alert("Please Login First...");
        window.location = "login.php";
    </script>
<?php
}

?>