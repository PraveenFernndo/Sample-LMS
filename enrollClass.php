<?php

require "connection.php";
session_start();
$teacher_id = $_GET["i1"];
$subject_id = $_GET["i2"];

$r1 = Database::search("select * from teacher where id='" . $teacher_id . "'");
$rs1 = $r1->fetch_assoc();

$r5 = Database::search("select * from teacher_has_class where teacher_email='" . $rs1["email"] . "' and subject_id='" . $subject_id . "' ");
$rs5 = $r5->fetch_assoc();

$r2 = Database::search("select * from subject where id='" . $subject_id . "'");
$rs2 = $r2->fetch_assoc();

$r3 = Database::search("select distinct(grade_id) from teacher_has_class where teacher_email='" . $rs1["email"] . "'");
$n3 = $r3->num_rows;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll Class</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="pictures/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body class="profile">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-4 border border-3 mt-5 rounded">
                        <div class="col-12 text-center">

                            <?php

                            $r = Database::search("select * from teacher_profile_picture where email='" . $rs1["email"] . "'");
                            $n = $r->num_rows;

                            if ($n == 1) {
                                $rs = $r->fetch_assoc();
                            ?>

                                <img src="<?php echo $rs["path"]; ?>" class="rounded-circle" style="width:600px;height:600px;" />
                            <?php
                            } else {
                            ?>
                                <img src="pictures/demoProfileImg.jpg" class="rounded-circle" />
                            <?php
                            }

                            ?>

                        </div>
                        <div class="col-12 text-center">
                            <span class="form-label fs-3 text-black"><?= $rs2["name"] ?></span>
                        </div>
                        <div class="col-12 text-center">
                            <span class="form-label text-black-50"></span>
                        </div>
                        <div class="col-12 text-center">
                            <span class="form-label fs-4 text-black-50"><?= $rs1["first_name"] ?> <?= $rs1["last_name"] ?></span>
                        </div>
                        <div class="col-12 text-center">
                            <span class="form-label text-black-50"><?= $rs1["degree"] ?></span>
                        </div>


                    </div>

                    <div class="col-12 col-lg-8 p-5">
                        <div class="row">
                            <div class="col-12">
                                <span class="text-danger fs-3">This teacher only teachs for
                                    <?php for ($a = 0; $a < $n3; $a++) {
                                        $grade_ids = $r3->fetch_assoc();
                                        $r12 = Database::search("select * from grade where id='" . $grade_ids["grade_id"] . "'");
                                        $grades = $r12->fetch_assoc();
                                    ?>
                                        <span class="text-danger fs-3"><?= $grades["name"] ?>, </span>
                                    <?php
                                    } ?> Students</span>
                            </div>
                            <div class="col-12">
                                <span class="form-label text-black fs-5"><?= $rs1["description"] ?></span>
                            </div>

                            <?php
                            $r6 = Database::search("select * from teacher_has_class where teacher_email='" . $rs1["email"] . "' and subject_id='" . $rs5["subject_id"] . "' ");
                            $n6 = $r6->num_rows;
                            for ($i = 0; $i < $n6; $i++) {
                                $rs6 = $r6->fetch_assoc();
                                $r7 = Database::search("select * from subject where id='" . $rs6["subject_id"] . "'");
                                $rs7 = $r7->fetch_assoc();
                                $r8 = Database::search("select * from medium where id='" . $rs6["medium_id"] . "'");
                                $rs8 = $r8->fetch_assoc();
                            ?>

                                <div class="col-lg-8 border rounded mt-2">

                                    <div class="col-12 mb-2">
                                        <span class="form-label fs-5 text-black-50">Grade <?= $rs6["grade_id"] ?> : <?= $rs7["name"] ?> : <?= $rs8["name"] ?> Medium</span>
                                    </div>
                                    <div class="col-12">
                                        <span class="form-label">Class Duration :</span>
                                        <span><?= $rs6["duration"] ?></span>
                                    </div>
                                    <div class="col-12">
                                        <span class="form-label">Monthly Fee :</span>
                                        <span>Rs .<?= $rs6["fee"] ?>.00</span>
                                    </div>

                                    <?php
                                    if (!empty($_SESSION["u"])) {
                                        $user_id = $_SESSION["u"]["id"];
                                    } else {
                                        $user_id = 0;
                                    }
                                    ?>

                                    <div class="col-12 mt-3 mb-3">
                                        <div class="row">
                                            <div class="col-4 d-grid">
                                                <a href="paymentProcess.php?ci=<?= $rs6["id"] ?>&&ui=<?= $user_id ?>" class="btn btn-success">Enroll Class</a>
                                            </div>

                                            <div class="col-4 d-grid">
                                                <?php

                                                $favourite_rs = Database::search("select * from favourite where user_id='" . $user_id . "' and subject_id='" . $rs6["subject_id"] . "' and grade_id='" . $rs6["grade_id"] . "' and medium_id='" . $rs6["medium_id"] . "' ");
                                                $favourite_num = $favourite_rs->num_rows;

                                                if ($favourite_num == 1) {
                                                ?>

                                                    <a class="btn btn-danger col-12 mt-1" onclick="addtoFavourite('<?= $user_id ?>','<?= $rs6['grade_id'] ?>','<?= $rs6['subject_id'] ?>','<?= $rs1['id'] ?>','<?= $rs6['medium_id'] ?>');">
                                                        Add to favourite <i class="bi bi-hand-thumbs-up-fill fs-5 text-primary" id="thumbs<?= $user_id ?><?= $rs6['grade_id'] ?><?= $rs6['subject_id'] ?><?= $rs1['id'] ?><?= $rs6['medium_id'] ?>"></i>
                                                    </a>

                                                <?php
                                                } else {
                                                ?>

                                                    <a class="btn btn-danger col-12 mt-1" onclick="addtoFavourite('<?= $user_id ?>','<?= $rs6['grade_id'] ?>','<?= $rs6['subject_id'] ?>','<?= $rs1['id'] ?>','<?= $rs6['medium_id'] ?>');">
                                                        Add to favourite <i class="d-none" id="heart<?= $user_id ?><?= $grade_id ?><?= $subject_id ?><?= $teacher_id ?><?= $rs6['medium_id'] ?>"></i>
                                                    </a>

                                                <?php
                                                }

                                                ?>
                                            </div>
                                            <?php

                                            if (!empty($_SESSION["u"]) || !empty($_SESSION["a"])) {

                                            ?>
                                                <div class="col-4 d-grid">
                                                    <?php

                                                    $watchlist_rs = Database::search("select * from wishList where user_id='" . $user_id . "' and subject_id='" . $rs6["subject_id"] . "' and grade_id='" . $rs6["grade_id"] . "' and medium_id='" . $rs6["medium_id"] . "'");
                                                    $watchlist_num = $watchlist_rs->num_rows;

                                                    if ($watchlist_num == 1) {
                                                    ?>

                                                        <a class="btn btn-secondary col-12 mt-1" onclick="addtoWishlist('<?= $user_id ?>','<?= $rs6['grade_id'] ?>','<?= $rs6['subject_id'] ?>','<?= $rs1['id'] ?>','<?= $rs6['medium_id'] ?>');">
                                                            Add to wishlist <i class="bi bi-heart-fill fs-5 text-danger" id="heart<?= $user_id ?><?= $rs6['grade_id'] ?><?= $rs6['subject_id'] ?><?= $rs1['id'] ?><?= $rs6['medium_id'] ?>"></i>
                                                        </a>

                                                    <?php
                                                    } else {
                                                    ?>

                                                        <a class="btn btn-secondary col-12 mt-1" onclick="addtoWishlist('<?= $user_id ?>','<?= $rs6['grade_id'] ?>','<?= $rs6['subject_id'] ?>','<?= $rs1['id'] ?>','<?= $rs6['medium_id'] ?>');">
                                                            Add to wishlist <i class="bi bi-heart-fill fs-5 text-white" id="heart<?= $user_id ?><?= $grade_id ?><?= $subject_id ?><?= $teacher_id ?><?= $rs6['medium_id'] ?>"></i>
                                                        </a>

                                                    <?php
                                                    }

                                                    ?>
                                                </div>
                                            <?php
                                            }
                                            ?>
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
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>