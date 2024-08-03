<?php

require "connection.php";
session_start();
if (!empty($_SESSION["t"])) {

    $grade_id = $_GET["gi"];
    $subject_id = $_GET["si"];
    $medium_id = $_GET["mi"];

    $r = Database::search("select * from grade where id='" . $grade_id . "'");
    $rs = $r->fetch_assoc();

    $r2 = Database::search("select * from subject where id='" . $subject_id . "'");
    $sub = $r2->fetch_assoc();

    $r3 = Database::search("select * from medium where id='" . $medium_id . "'");
    $medium = $r3->fetch_assoc();

    $total_students = 0;
    $total_active_students = 0;
    $total_income = 0;
    $service_charge = 0;
    $total = 0;

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Class</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="pictures/logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    </head>

    <body class="profile">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <span class="form-label text-black-50 fs-3"><?= $rs["name"] ?> <?= $sub["name"] ?> Class</span>
                </div>
                <div class="col-12 text-center">
                    <span class="form-label text-danger fs-3"><?= $medium["name"] ?> Medium</span>
                </div>

                <div class="col-md-2 col-12 mt-2  border-end border-2 p-2">

                    <?php
                    $a = Database::search("select * from teacher_has_class where teacher_email='" . $_SESSION["t"]["email"] . "' and subject_id='" . $subject_id . "' and medium_id='" . $medium_id . "' and grade_id='" . $grade_id . "'");
                    $as = $a->fetch_assoc();

                    $a1 = Database::search("select * from student_has_class where class_id='" . $as["id"] . "'");
                    $na1 = $a1->num_rows;
                    if ($na1 > 0) {
                        for ($x = 0; $x < $na1; $x++) {
                            $as1 = $a1->fetch_assoc();

                            $a2 = Database::search("select * from user where id='" . $as1["student_id"] . "'");
                            $as2 = $a2->fetch_assoc();

                            $total_students = $total_students + 1;

                            if ($as1["status"] == "1") {
                                $total_active_students = $total_active_students + 1;
                    ?>

                                <div class="col-12 border-bottom border-1">
                                    <span class="text-success"><?= $as2["first_name"] ?> <?= $as2["last_name"] ?></span>&nbsp;&nbsp;
                                    <a href="teacherToStudentMessage.php?i1=<?= $as1["student_id"] ?>&&i2=<?= $_SESSION["t"]["id"] ?>"><i class="bi bi-chat-fill"></i></a>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col-12 border-bottom border-1">
                                    <span class="text-danger"><?= $as2["first_name"] ?> <?= $as2["last_name"] ?></span>&nbsp;&nbsp;
                                    <a href="teacherToStudentMessage.php?i1=<?= $as1["student_id"] ?>&&i2=<?= $_SESSION["t"]["id"] ?>"><i class="bi bi-chat-fill"></i></a>
                                </div>
                            <?php
                            }

                            ?>

                        <?php

                        }
                    } else {
                        ?>
                        <div class="col-12 border-bottom border-1">
                            <span>No Students</span>&nbsp;&nbsp;
                        </div>
                    <?php
                    }
                    ?>

                </div>

                <div class="col-lg-6 col-12 mt-2 ms-lg-5 p-3 border border-dark border-2 rounded">

                    <div class="col-12 border-1 border-bottom p-2">
                        <div class="row">
                            <div class="col-12">
                                <span class="text-danger">important*</span><br />
                                <span>First, You should upload your video to youtube or facebook then upload the link here.</span>
                            </div>
                            <div class="col-12 mt-2">
                                <input type="text" id="videoDescription" class=" form-control" placeholder="Add a Description" value="" />
                            </div>
                            <div class="col-12 mt-2">
                                <input type="url" id="videoUrl" class="form-control" placeholder="Add URL" value="" />
                            </div>
                            <div class="col-12 mt-2">
                                <label class="btn btn-info col-12" for="videoUploader" onclick="videoUploader('<?= $rs['id'] ?>','<?= $subject_id ?>','<?= $medium['id'] ?>');">Upload Video</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-12 p-3 ms-lg-5 mt-2 border border-2 border-dark rounded">

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 mt-4">
                                <span>If any .pdf document available, attach here</span>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control" placeholder="Add File Description" id="fileDescription" />
                            </div>
                            <div class="col-12  mt-1">
                                <input type="file" accept=".pdf" class="form-control" id="fileChooser" />

                            </div>
                            <div class="col-12  mt-1">
                                <label class="btn btn-success col-12 mt-2" onclick="noteUploader('<?= $rs['id'] ?>','<?= $subject_id ?>','<?= $medium['id'] ?>')">Select File</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 mt-5">
                    <div class="row">
                        <div class="col-12">
                            <span class="form-label">Total Student Count : <?= $total_students ?></span>
                        </div>
                        <div class="col-12">
                            <span class="form-label">Total Active Student Count : <?= $total_active_students ?></span>
                        </div>

                        <!-- calculate total income -->

                        <?php
                        $m=Database::search("select * from payment where class_id='".$as["id"]."' and withdraw_status='0'");
                        $mn=$m->num_rows;
                        for($x=0;$x<$mn;$x++){
                            $ms=$m->fetch_assoc();
                            $total_income=$total_income+floatval($ms["price"]);
                        }
                        ?>

                        <!-- calculate total income -->

                        <div class="col-12">
                            <span class="form-label">Income : Rs.<?= $total_income ?>.00</span>
                        </div>
                        <?php
                        //if total income>=100000, service charge rate is 20% and else service rate is 10%
                        if ($total_income <= 100000) {
                            $service_charge = $total_income * 0.1;
                        } else {
                            $service_charge = $total_income * 0.2;
                        }

                        $total = $total_income - $service_charge;
                        ?>
                        <div class="col-12">
                            <span class="form-label">Service Charges : Rs.<?= $service_charge ?>.00 </span>
                        </div>
                        <div class="col-12">
                            <span class="form-label">Total Income : Rs.<?= $total ?>.00 </span>
                        </div><br />
                        <div class="col-12 p-3">
                            <a href="paymentWithdrow.php?ti=<?=$total_income?>&&ci=<?=$as["id"]?>" class="btn btn-dark">Withdraw Money</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 mt-5 p-3">
                    <span class="text-black-50 fs-4">Uploaded Videos</span>
                    <div class="row">

                        <?php

                        $r1 = Database::search("select * from lesson_videos where teacher_email='" . $_SESSION["t"]["email"] . "' and grade_id='" . $grade_id . "' and subject_id='" . $subject_id . "' and medium_id='" . $medium_id . "'");
                        $n1 = $r1->num_rows;

                        for ($x = 0; $x < $n1; $x++) {
                            $rs1 = $r1->fetch_assoc();
                        ?>


                            <div class="col-lg-3 text-center border border-dark rounded">
                                <span><?= $rs["name"] ?></span><br />
                                <span class="text-black-50 fs-5"><?= $sub["name"] ?></span><br />
                                <span class="text-danger"><?= $rs1["description"] ?></span><br />
                                <a href="<?= $rs1["url"] ?>" class="btn btn-info mt-2 mb-2">Watch Video</a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>


                <div class="col-lg-8 mt-5 p-3">
                    <span class="text-black-50 fs-4">Uploaded Notes</span>
                    <div class="row">

                        <?php

                        $r1 = Database::search("select * from lesson_notes where teacher_email='" . $_SESSION["t"]["email"] . "' and grade_id='" . $grade_id . "' and subject_id='" . $subject_id . "' and medium_id='" . $medium_id . "'");
                        $n1 = $r1->num_rows;

                        for ($x = 0; $x < $n1; $x++) {
                            $rs1 = $r1->fetch_assoc();
                        ?>


                            <div class="col-lg-3 text-center border border-dark rounded">
                                <span><?= $rs["name"] ?></span><br />
                                <span class="text-black-50 fs-5"><?= $sub["name"] ?></span><br />
                                <span class="text-danger"><?= $rs1["description"] ?></span><br />
                                <a href="<?= $rs1["path"] ?>" target="blank" class="btn btn-info mt-2 mb-2">View Note</a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- pdf upload -->



                <!-- <div class="col-lg-4 border border-3 border-dark">
                    <div class="row">

                        <div class="col-12">

                        </div>

                    </div>
                </div> -->



            </div>
        </div>

        <script src="script.js"></script>

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