<?php
require "connection.php";
session_start();

$email = $_GET["email"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student View</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="pictures/logo.png" />

</head>

<body class="profile">
    <div class="container-fluid">
        <div class="row">
            <?php

            $r1 = Database::search("select * from user where email='" . $email . "'");
            $rs1 = $r1->fetch_assoc();

            $r2 = Database::search("select * from gender where id='" . $rs1["gender_id"] . "'");
            $rs2 = $r2->fetch_assoc();

            $r3 = Database::search("select * from grade where id='" . $rs1["grade_id"] . "'");
            $rs3 = $r3->fetch_assoc();



            ?>

            <div class="col-lg-10 border border-2 mt-3 rounded offset-lg-1 border-danger">
                <div class="row">
                    <div class="col-lg-8 border-end">
                        <!-- teacher details -->
                        <div class="row">
                            <div class="col-12 mt-1">
                                <span>Name : <?= $rs1["first_name"] ?> <?= $rs1["last_name"] ?></span>
                            </div>
                            <div class="col-6 mt-2">
                                <span>Gender : <?= $rs2["name"] ?></span>
                            </div>
                            <!-- <div class="col-6 mt-2">
                                <span>Start Grade : <?= $rs3["name"] ?></span>
                            </div> -->
                            <!-- <div class="col-6 mt-2">
                                <span>End Grade : <?= $rs4["name"] ?></span>
                            </div> -->
                            <div class="col-12 mt-2">
                                <span>Email : <?= $email ?></span>
                            </div>
                            <div class="col-12 mt-2">
                                <span>Mobile : <?= $rs1["mobile"] ?></span>
                            </div>
                            <div class="col-12 mt-2">
                                <span>Address : <?= $rs1["address"] ?></span>
                            </div>
                            <div class="col-12 mt-2">
                                <span>Grade : <?= $rs3["name"] ?></span>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="row p-2">
                                    <span>Classes</span>
                                    <?php
                                    $r4 = Database::search("select * from student_has_class where student_id='" . $rs1["id"] . "'");

                                    $nr = $r4->num_rows;

                                    if ($nr > 0) {
                                        for ($x = 0; $x < $nr; $x++) {

                                            $rs4 = $r4->fetch_assoc();
                                            $f = Database::search("select * from teacher_has_class where id='" . $rs4["class_id"] . "'");

                                            $fs = $f->fetch_assoc();
                                            $s = Database::search("select * from subject where id='" . $fs["subject_id"] . "'");
                                            $g = Database::search("select * from grade where id='" . $fs["grade_id"] . "'");
                                            $m = Database::search("select * from medium where id='" . $fs["medium_id"] . "'");

                                            $sub = $s->fetch_assoc();
                                            $gra = $g->fetch_assoc();
                                            $md = $m->fetch_assoc();

                                    ?>

                                            <div class="col-4 text-center border rounded m-2 p-2">
                                                <span>Grade : <?= $gra["name"] ?></span><br />
                                                <span>Subject : <?= $sub["name"] ?></span><br />
                                                <span>Medium : <?= $md["name"] ?></span><br />

                                                <?php

                                                if ($rs4["status"] == "1") {
                                                ?>
                                                    <span class="text-success">Paid</span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="text-danger">Not Paid</span>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <hr />

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fs-5 fw-bold">Student Payment History</label>
                                                </div>
                                                <?php
                                                $p = Database::search("select * from payment inner join student_has_class on student_has_class.class_id=payment.class_id inner join teacher_has_class on teacher_has_class.id=payment.class_id where student_has_class.student_id='" . $rs1["id"] . "' ");
                                                $np = $p->num_rows;
                                                if ($np > 0) {
                                                    for ($x = 0; $x < $np; $x++) {
                                                        $ps = $p->fetch_assoc();

                                                        $s1 = Database::search("select * from subject where id='" . $ps["subject_id"] . "'");
                                                        $g1 = Database::search("select * from grade where id='" . $ps["grade_id"] . "'");
                                                        $m1 = Database::search("select * from medium where id='" . $ps["medium_id"] . "'");

                                                        $sub1 = $s1->fetch_assoc();
                                                        $gra1 = $g1->fetch_assoc();
                                                        $md1 = $m1->fetch_assoc();

                                                ?>
                                                        <div class="col-12 border rounded">
                                                            <div class="row">
                                                                <div class="col-lg-3"><?= $ps["teacher_email"] ?></div>
                                                                <div class="col-3 col-lg-1"><?= $gra1["name"] ?></div>
                                                                <div class="col-3 col-lg-2"><?= $sub1["name"] ?></div>
                                                                <div class="col-3 col-lg-2"><?= $md1["name"] ?> Medium</div>
                                                                <div class="col-3 col-lg-2">Rs.<?= $ps["price"] ?>.00</div>
                                                                <div class="col-3 col-lg-2"><?= $ps["date"] ?></div>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                }

                                                ?>
                                                <div class="col-12">

                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }

                                    ?>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4">

                        <?php

                        $r5 = Database::search("select * from student_profile_picture where email='" . $email . "'");
                        $n5 = $r5->num_rows;

                        if ($n5 == 1) {
                            $rs5 = $r5->fetch_assoc();
                            $src = $rs5["path"];
                        } else {
                            $src = "pictures/demoProfileImg.jpg";
                        }

                        $r6 = Database::search("select * from teacher_qualification where email='" . $email . "'");
                        $rs6 = $r6->fetch_assoc();

                        ?>
                        <!-- teacher profile picture -->
                        <div class="col-12 text-center">
                            <img src="<?= $src ?>" style="width:200px;" class="rounded" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="script.js"></script>

</body>

</html>