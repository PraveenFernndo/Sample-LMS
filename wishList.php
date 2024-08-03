<?php

require "connection.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Wishlist</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php

            if (!empty($_SESSION["u"]) || !empty($_SESSION["a"])) {

            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border border-1 border-secondary rounded">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label fs-1 fw-bolder">Wishlist &hearts;</label>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-breake-1" />
                                </div>

                                <div class="col-12">
                                    <span class="fs-5 text-black-50">My Wish List</span>
                                </div>


                                <?php
                                $user_id = $_GET["i"];
                                $watchlist_rs = Database::search("select * from wishList where user_id='" . $user_id . "'");
                                $watchlist_num = $watchlist_rs->num_rows;
                                if ($watchlist_num == 0) {
                                ?>

                                    <!-- no items -->

                                    <div class="col-12">
                                        <div class="col-12">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold">You have no items in your watchlist yet</label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="index.php" class="btn btn-warning fs-5 fw-bold">Try To Add Something To Your Wish List</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- no items -->

                                <?php
                                } else if ($watchlist_num > 0) {
                                ?>

                                    <div class="col-12">
                                        <div class="row g-2 p-3">
                                            <?php
                                            for ($x = 0; $x < $watchlist_num; $x++) {
                                                $watchlist_data = $watchlist_rs->fetch_assoc();
                                                $subject_id = $watchlist_data["subject_id"];
                                                $grade_id = $watchlist_data["grade_id"];
                                                $teacher_id = $watchlist_data["teacher_id"];
                                                $medium_id = $watchlist_data["medium_id"];

                                                $r1 = Database::search("select * from teacher where id='" . $teacher_id . "'");
                                                $r2 = Database::search("select * from subject where id='" . $subject_id . "'");
                                                $r3 = Database::search("select * from grade where id='" . $grade_id . "'");
                                                $r4 = Database::search("select * from medium where id='" . $medium_id . "'");
                                                $rs1 = $r1->fetch_assoc();
                                                $rs2 = $r2->fetch_assoc();
                                                $rs3 = $r3->fetch_assoc();
                                                $rs4 = $r4->fetch_assoc();
                                            ?>
                                                <!-- have product -->


                                                <!-- Card -->
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-12 mt-2 row">
                                                            <div class="card" style="width: 18rem;">
                                                                <div class="col-12 text-center">
                                                                    <?php
                                                                    $r = Database::search("select * from teacher_profile_picture where email='" . $rs1["email"] . "'");
                                                                    $n = $r->num_rows;

                                                                    if ($n == 1) {
                                                                        $rs = $r->fetch_assoc();
                                                                    ?>
                                                                        <img src="<?php echo $rs["path"]; ?>" class="rounded-circle" style="width:100px;" />
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <img src="pictures/demoProfileImg.jpg" class="rounded-circle" style="width:100px;" />
                                                                    <?php
                                                                    }

                                                                    ?>
                                                                </div>
                                                                <div class="card-body text-center">
                                                                    <h5 class="card-title text-black-50"><?= $rs2["name"] ?></h5>
                                                                    <h5 class="card-title text-black-50"><?= $rs3["name"] ?></h5>
                                                                    <h5 class="card-title text-danger"><?= $rs4["name"] ?> Medium</h5>
                                                                    <h5 class="card-title"><?= $rs1["first_name"] ?> <?= $rs1["last_name"] ?></h5>
                                                                    <p class="card-text"><?= $rs1["degree"] ?></p>
                                                                    <a href="enrollClass.php?i1=<?= $rs1["id"] ?>&&i2=<?= $rs2["id"] ?>" class="btn btn-primary col-12">More Details</a>

                                                                    <div class="col-12 d-grid">
                                                                        <?php

                                                                        $watchlist_rs1 = Database::search("select * from wishList where user_id='" . $user_id . "' and subject_id='" . $subject_id . "' and grade_id='" . $grade_id . "' ");
                                                                        $watchlist_num1 = $watchlist_rs1->num_rows;

                                                                        if ($watchlist_num1 >= 1) {
                                                                        ?>

                                                                            <a class="btn btn-secondary col-12 mt-1" onclick="addtoWishlist('<?= $user_id ?>','<?= $grade_id ?>','<?= $subject_id ?>','<?= $teacher_id ?>',<?=$medium_id?>);">
                                                                                <i class="bi bi-heart-fill fs-5 text-danger" id="heart<?= $user_id ?><?= $grade_id ?><?= $subject_id ?><?= $teacher_id ?><?=$medium_id?>"></i>
                                                                            </a>

                                                                        <?php
                                                                        } else {
                                                                        ?>

                                                                            <a class="btn btn-secondary col-12 mt-1" onclick="addtoWishlist('<?= $user_id ?>','<?= $grade_id ?>','<?= $subject_id ?>','<?= $teacher_id ?>','<?=$medium_id?>');">
                                                                                <i class="bi bi-heart-fill fs-5 text-white" id="heart<?= $user_id ?><?= $grade_id ?><?= $subject_id ?><?= $teacher_id ?><?=$medium_id?>"></i>
                                                                            </a>

                                                                        <?php
                                                                        }

                                                                        ?>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                }

                                                    ?>
                                                    </div>
                                                </div>
                                                <!-- Card -->
                                                <!-- have product -->

                                            <?php
                                        }

                                            ?>
                                        </div>
                                    </div>
                                <?php


                            }
                                ?>

                            </div>
                        </div>


                        <script src="script.js"></script>
                        <script src="bootstrap.js"></script>
</body>

</html>