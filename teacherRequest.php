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
    <title>Teacher Request</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="pictures/logo.png" />

</head>

<body class="profile">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <span class="form-label fs-3 text-black-50">Request Confirmation</span>
            </div>

            <?php

            $r1 = Database::search("select * from teacher where email='" . $email . "'");
            $rs1 = $r1->fetch_assoc();

            $r2 = Database::search("select * from gender where id='" . $rs1["gender_id"] . "'");
            $rs2 = $r2->fetch_assoc();

            // $r3=Database::search("select * from grade where id='".$rs1["grade_from_id"]."'");
            // $rs3=$r3->fetch_assoc();

            // $r4=Database::search("select * from grade where id='".$rs1["grade_to_id"]."'");
            // $rs4=$r4->fetch_assoc();

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
                            <div class="col-12 mt-2">
                                <span>Class Details : <?= $rs1["class_details"] ?></span>
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
                                <span>Degree : <?= $rs1["degree"] ?></span>
                            </div>
                            <div class="col-12 mt-2">
                                <span>Address : <?= $rs1["address"] ?></span>
                            </div>
                            <div class="col-12 mt-2">
                                <span>Institute : <?= $rs1["institute"] ?></span>
                            </div>
                            <div class="col-12 mt-2">
                                <span>Description : <?= $rs1["description"] ?></span>
                            </div>

                        </div>
                        <!-- teacher details -->

                        <!-- accept or reject request buttons -->
                        <div class="col-12 mt-3 mb-3">

                            <?php
                            if ($rs1["status"] == "1") {
                            ?>
                                <!-- if accepted -->
                                <div class="row">
                                    <div class="col-6 d-grid">
                                        <button class="btn btn-success" onclick="teacherRequestAcceptProcess('1','<?= $email ?>');">Accepted</button>
                                    </div>
                                    <div class="col-6 d-grid">
                                        <button class="btn btn-danger" onclick="teacherRequestAcceptProcess('0','<?= $email ?>');">Remove</button>
                                    </div>
                                </div>

                                <div class="col-12 mt-2 p-2" id="classAssignDiv">
                                    <div class="col-12">
                                        <span class="text-black-50">Add Class To Teacher</span>
                                    </div>
                                    <div class="row  border border-dark rounded p-2">

                                        <div class="col-2">
                                            <div class="col-12">
                                                <span>Grade</span>
                                            </div>
                                            <select id="teacherGrade" class="form-select">
                                                <option>Select</option>
                                                <?php
                                                $r3 = Database::search("select * from grade");
                                                $n3 = $r3->num_rows;
                                                for ($x = 0; $x < $n3; $x++) {
                                                    $rs3 = $r3->fetch_assoc();
                                                ?>
                                                    <option value="<?= $rs3["id"] ?>"><?= $rs3["name"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <div class="col-12">
                                                <span>Subject</span>
                                            </div>
                                            <select id="teacherSubject" class="form-select">
                                                <option>Select</option>
                                                <?php
                                                $r3 = Database::search("select * from subject");
                                                $n3 = $r3->num_rows;
                                                for ($x = 0; $x < $n3; $x++) {
                                                    $rs3 = $r3->fetch_assoc();
                                                ?>
                                                    <option value="<?= $rs3["id"] ?>"><?= $rs3["name"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-2">
                                            <div class="col-12">
                                                <span>Medium</span>
                                            </div>
                                            <select id="teacherMedium" class="form-select">
                                                <option>Select</option>
                                                <?php
                                                $r3 = Database::search("select * from medium");
                                                $n3 = $r3->num_rows;
                                                for ($x = 0; $x < $n3; $x++) {
                                                    $rs3 = $r3->fetch_assoc();
                                                ?>
                                                    <option value="<?= $rs3["id"] ?>"><?= $rs3["name"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-2">
                                            <div class="col-12">
                                                <span>Fees</span>
                                            </div>

                                            <div class="col-12">
                                                <input type="text" class="form-control" id="fees" />
                                            </div>

                                        </div>

                                        <div class="col-2">
                                            <div class="col-12">
                                                <span>Duration</span>
                                            </div>

                                            <div class="col-12">
                                                <input type="text" class="form-control" id="duration" />
                                            </div>

                                        </div>

                                        <div class="col-12 mt-2">
                                            <label class="btn btn-primary col-12" onclick="addClassToTeacher('<?= $email ?>');">Add Class</label>
                                        </div>

                                        <?php
                                        $r3 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "'");
                                        $n3 = $r3->num_rows;
                                        if ($n3 > 0) {
                                            for ($x = 0; $x < $n3; $x++) {
                                                $rs3 = $r3->fetch_assoc();

                                                $r4 = Database::search("select * from subject where id='" . $rs3["subject_id"] . "'");
                                                $rs4 = $r4->fetch_assoc();
                                                $r5 = Database::search("select * from medium where id='" . $rs3["medium_id"] . "'");
                                                $rs5 = $r5->fetch_assoc();
                                        ?>
                                                <div class="col-12 text-black-50">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <span><?= $rs4["name"] ?></span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span>Grade <?= $rs3["grade_id"] ?></span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span><?= $rs5["name"] ?> Medium</span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span>Rs.<?= $rs3["fee"] ?></span>
                                                        </div>
                                                        <div class="col-3">
                                                            <span><?= $rs3["duration"] ?></span>
                                                        </div>
                                                        <div class="col-1">
                                                            <span class="text-info text-decoration-underline" style="cursor: pointer;" onclick="removeClass('<?= $email ?>','<?= $rs3['grade_id'] ?>','<?= $rs3['subject_id'] ?>');">remove</span>
                                                        </div>
                                                    </div>
                                                </div>

                                        <?php
                                            }
                                        }
                                        ?>

                                        <br />
                                        <br />
                                        <a href="manageTeacher.php?e=<?= $email ?>">Manage Teacher Details</a>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="col-12">
                                        <label class="form-label fw-bold fs-3">Withdrawel History</label>
                                    </div>
                                    <span>(SC- Service Charge)</span>
                                    <br/><br/>
                                    <?php
                                    $t = Database::search("select * from teacher_withdraw inner join teacher_has_class on teacher_has_class.id=teacher_withdraw.class_id where teacher_has_class.teacher_email='" . $email . "'");
                                    $nt = $t->num_rows;

                                    if ($nt > 0) {
                                        for ($x = 0; $x < $nt; $x++) {
                                            $ts = $t->fetch_assoc();
                                    ?>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <span class="form-label"><?= $ts["date_time"] ?></span>
                                                    </div>
                                                    <div class="col-4">
                                                        <span class="form-label">Rs.<?= $ts["amount"] ?>.00</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <span class="form-label">Rs.<?= $ts["service_charges"] ?>.00(SC)</span>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }

                                    ?>
                                </div>

                            <?php
                            } else if ($rs1["status"] == "0") {
                            ?>
                                <!-- if not accepted yet -->
                                <div class="row">
                                    <div class="col-6 d-grid">
                                        <button class="btn btn-success" onclick="teacherRequestAcceptProcess('1','<?= $email ?>');">Accept Request</button>
                                    </div>
                                    <div class="col-6 d-grid">
                                        <button class="btn btn-danger" onclick="teacherRequestAcceptProcess('0','<?= $email ?>');">Reject Request</button>
                                    </div>
                                </div>

                            <?php
                            } else if ($rs1["status"] == "2") {
                            ?>
                                <!-- if rejected -->
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <span class="text-danger fs-3">Rejected !!</span>
                                    </div>
                                    <div class="col-12 d-grid">
                                        <button class="btn btn-success" onclick="teacherRequestAcceptProcess('1','<?= $email ?>');">Accept Request</button>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>

                        </div>
                        <!-- accept or reject request buttons -->

                        <!-- Add new Class To teacher -->

                    </div>

                    <div class="col-lg-4">

                        <?php

                        $r5 = Database::search("select * from teacher_profile_picture where email='" . $email . "'");
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
                        <!-- teacher qualification -->
                        <div class="col-12 text-center mt-5 mb-3">
                            <img src="<?= $rs6["path"] ?>" style="width:500px;" class="rounded" /><br />
                            <a href="<?= $rs6["path"] ?>" download>Download</a>
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <script src="script.js"></script>

</body>

</html>