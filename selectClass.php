<?php
require "connection.php";
session_start();
if (!empty($_SESSION["t"])) {

    $email = $_SESSION["t"]["email"];

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

                    $r = Database::search("select * from teacher_has_class where teacher_email='" . $email . "'");
                    $n = $r->num_rows;


                    for ($i = 0; $i < $n; $i++) {
                        $rs = $r->fetch_assoc();
                        $r1 = Database::search("select * from grade where id='" . $rs["grade_id"] . "'");
                        $r2 = Database::search("select * from subject where id='" . $rs["subject_id"] . "'");
                        $r3 = Database::search("select * from medium where id='" . $rs["medium_id"] . "'");

                        $rs1 = $r1->fetch_assoc();
                        $rs2 = $r2->fetch_assoc();
                        $rs3 = $r3->fetch_assoc();

                    ?>

                        <div class="col-lg-3 p-3 mt-2 mb-2 border bordr-2 rounded col-10 offset-1 offset-lg-0">
                            <div class="col-12 text-center">
                                <span>Go to <?= $rs1["name"] ?> <?=$rs2["name"]?> Class</span>
                            </div>
                            <div class="col-12 text-center">
                                <span class="text-danger"><?=$rs3["name"]?> Medium</span>
                            </div>
                            <div class="col-12 text-center mt-1">
                                <a href="class.php?gi=<?=$rs["grade_id"]?>&si=<?=$rs["subject_id"]?>&mi=<?=$rs3["id"]?>" class="btn btn-primary">Go to Class</a>
                            </div>
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