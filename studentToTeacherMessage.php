<?php
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message To Teacher</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="pictures/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 border rounded offset-lg-1 p-3 mt-5">
                <div class="row">
                    <?php
                    if (!empty($_GET["i1"]) && !empty($_GET["i2"])) {

                        $class_id = $_GET["i2"];
                        $student_id = $_GET["i1"];

                        $f = Database::search("select * from teacher_has_class where id='" . $class_id . "'");
                        $fs = $f->fetch_assoc();
                        $f1 = Database::search("select * from teacher where email='" . $fs["teacher_email"] . "'");
                        $fs1 = $f1->fetch_assoc();

                        $teacher_email=$fs1["email"];

                        $r = Database::search("select * from user where id='" . $student_id . "'");
                        $n = $r->num_rows;
                        $rs = $r->fetch_assoc();
                        $student_email=$rs["email"];
                        $r1 = Database::search("select * from messages where `to`='".$teacher_email."' and `from`='" . $rs["email"] . "' order by date_time DESC");
                        $n1 = $r1->num_rows;
                        if ($n1 > 0) {
                            for ($x = 0; $x < $n1; $x++) {
                                $rs1 = $r1->fetch_assoc();
                    ?>
                                <div class="col-12 mt-3 border rounded p-2">
                                    <span class="fw-bold">Message : </span>
                                    <span><?= $rs1["message"] ?></span><br />
                                    <span class="fw-bold">Reply : </span>
                                    <span><?= $rs1["reply"] ?></span>
                                </div>
                        <?php
                            }
                        }
                        ?>



                    <?php
                    }
                    ?>

                </div>
            </div>

            <div class="col-lg-10 offset-lg-1">

                <!-- text -->

                <div class="col-12 mt-5">
                    <div class="row">
                        <div class="input-group">
                            <input type="text" placeholder="Type new message here..." aria-describedby="sendbtn" class="form-control rounded-0 border-0 py-3 bg-light" id="msgTxt" />
                            <button id="sendbtn" class="btn btn-link fs-2 bg-dark" onclick="messageToTeacher('<?=$student_email?>','<?=$teacher_email?>');">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- text -->
            </div>

        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>