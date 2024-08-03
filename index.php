<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="pictures/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>Tution Class</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div style="width: 100%;">
                <div class="menuBar">

                </div>
            </div>
            <!-- Menu Bar -->
            <?php

            if (!empty($_SESSION["a"])) {
                $i = 0;
            ?>
                <!-- admin menu bar view -->
                <div class="col-12 bg-white pt-1">
                    <div class="row">

                        <!-- menu icon -->
                        <div class="col-1 pt-3 d-lg-none"><i class="bi bi-list hover-effect d-flex" onclick="displayMenu();"></i></div>
                        <!-- menu icon -->

                        <!-- large screen menu-->
                        <div class="col-7 d-none d-lg-block">
                            <div class="row g-2">

                                <div class="col-3">
                                    <a href="advancedSearch.php" class="btn btn-outline-primary text-black fs-5 col-lg-10">Search&nbsp;<i class="bi bi-search"></i></a>
                                </div>
                                <div class="col-3">
                                    <a href="adminPanel.php" class="btn btn-outline-primary text-black fs-5 col-lg-10">Admin Panel</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-6">
                            <label class="form-label p-2 ps-lg-4 ps-1 text-decoration-underline hover-effect" id="login"><a href="login.php" class="text-black"><i class="bi bi-person-circle pe-2"></i>Login</label>
                            <label class="form-label p-2 ps-lg-4 ps-1 text-decoration-underline hover-effect"><a href="selectRegisterType.php" class="text-black"><i class="bi bi-person-plus-fill pe-2"></i>Register</a></label>
                            <label class="form-label p-2 ps-lg-4 ps-1 text-decoration-underline hover-effect"><a href="wishList.php?i=<?= $i ?>" class="text-black"><i class="bi bi-suit-heart-fill"></i> Wish List</a></label>
                            <label class="form-label p-2 ps-lg-2 ps-1 text-decoration-underline hover-effect"><a href="favourite.php?i=<?= $i ?>" class="text-black"><i class="bi bi-hand-thumbs-up-fill"></i></i> My Favourite</a></label>
                            <label class="form-label p-2 ps-lg-2 ps-1 text-decoration-underline hover-effect"><i class="bi bi-power" onclick="logout();"></i></label>
                        </div>
                        <!-- large screen menu-->

                    </div>
                </div>

                <!-- small Screen menu items -->
                <div class="col-4 d-block d-lg-none">


                    <div class="col-12 bg-white pb-1 rounded-bottom d-none" id="smallMenu">
                        <ul>
                            <li class="menu-effects"><a href="advancedSearch.php">Search</a></li>
                            <li class="menu-effects"><a href="adminPanel.php">Admin Panel</a></li>
                            <li class="menu-effects"><a href="#">Admin Profile</a></li>
                        </ul>
                    </div>
                </div>
                <!-- small Screen menu items -->
                <!-- admin menu bar view -->
            <?php
            } else {
            ?>
                <!-- other view -->

                <div class="col-12 bg-white pt-1">
                    <div class="row">

                        <!-- menu icon -->
                        <div class="col-1 pt-3 d-lg-none"><i class="bi bi-list hover-effect d-flex" onclick="displayMenu();"></i></div>
                        <!-- menu icon -->

                        <!-- large screen menu-->
                        <div class="col-7 p-1 d-none d-lg-block d-flex flex-row align-items-center">
                            <div class="row g-2">
                                <div class="col-8 ps-2 d-flex flex-row align-items-center">
                                    <img src="pictures/logo.png" style="width: 100px;margin-right:20px" />
                                    <label>F U T U R E H E R O S</label>

                                </div>
                                <div class="col-4 p-3">
                                </div>

                            </div>
                        </div>
                        <!-- large screen menu-->

                        <div class="col-11 col-lg-5 pt-3 d-flex justify-content-end flex-row">

                            <a href="advancedSearch.php" class="pe-5 text-black"><i class="bi bi-search pe-2"></i>Search</a>

                            <label class="form-label pe-5 text-decoration-underline hover-effect" id="login"><a href="login.php" class="text-black"><i class="bi bi-person-circle pe-2"></i></label>
                            <label class="form-label pe-3 text-decoration-underline hover-effect"><a href="selectRegisterType.php" class="text-black"><i class="bi bi-person-plus-fill pe-2"></i></a></label>



                            <?php
                            if (!empty($_SESSION["u"])) {
                                if (!empty($_SESSION["u"])) {
                                    $i = $_SESSION["u"]["id"];
                                }
                            ?>
                                <label class="form-label pe-5 text-decoration-underline hover-effect ms-5"><a href="wishList.php?i=<?= $i ?>" class="text-black"><i class="bi bi-suit-heart-fill"></i></a></label>
                                <label class="form-label pe-5 text-decoration-underline hover-effect"><a href="favourite.php?i=<?= $i ?>" class="text-black"><i class="bi bi-hand-thumbs-up-fill"></i></i></a></label>
                                <label class="form-label pe-5 text-decoration-underline hover-effect"><i class="bi bi-power" onclick="logout();"></i></label>

                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>

                <!-- small Screen menu items -->
                <div class="col-4 d-block d-lg-none">


                    <div class="col-12 bg-white pb-1 rounded-bottom d-none" id="smallMenu">
                        <ul>
                            <li class="menu-effects"><a href="index.php">Search</a></li>
                            <li class="menu-effects"><a href="studentProfile.php">Student Profile</a></li>
                            <li class="menu-effects"><a href="teacherProfile.php">Teacher Profile</a></li>
                        </ul>
                    </div>
                </div>
                <!-- small Screen menu items -->

                <!-- other view -->
            <?php
            }
            ?>
            <!-- Menu Bar -->

            <!-- logo image -->
            <!-- <div class="d-none d-lg-block col-lg-2 logo-image p-0 offset-lg-5"></div> -->
            <!-- logo image -->

            <div class="col-12">
                <div class="row p-2">

                    <!-- slide div -->
                    <!-- <div class="col-6 rounded">

                        <div class="col-12 d-none d-lg-block">
                            <div class="row">
                                <div id="carouselExampleCaptions" class="col-8 offset-2 carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="pictures/i1.jpg" class="d-block poster-imgs">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="pictures/i2.jpg" class="d-block poster-imgs">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="pictures/i3.jpg" class="d-block poster-imgs">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div> -->
                    <!-- news -->
                    <!-- <div class="col-10 offset-1 offset-lg-0 col-lg-6 border border-3 border-white rounded">
                        <span class="form-label fs-5 fw-bold text-decoration-underline">Latest News</span>
                        <div class="col-10 offset-1">
                            <ul class="text-black">

                                <?php
                                $f = Database::search("select * from news");
                                $nf = $f->num_rows;
                                if ($nf > 0) {
                                    for ($z = 0; $z < $nf; $z++) {
                                        $fs = $f->fetch_assoc();
                                ?>

                                        <li><?= $fs["news_description"] ?></li>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col-12 text-center mt-5">
                                        <label class="text-black-50 col-12 fs-3">No News Available</label>
                                    </div>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div> -->
                    <!-- news -->

                </div>
            </div>

            <div class="col-12 d-none d-lg-block d-flex flex-row mt-5">
                <div class="text-center main-banner rounded p-5">
                    <h2 class="text-white">Every course has real-world projects designed to develop the skills you need to reach your career goals.</h2>
                    
                    <div class="col-10 offset-1 d-flex flex-row justify-content-center pt-5">
                        <div class="d-flex flex-column bg-white rounded p-5 m-5 justify-content-center">
                            <img src="pictures/analysis.png" />
                            <label>Analysis</label>
                        </div>
                        <div class="d-flex flex-column bg-white rounded p-5 m-5 justify-content-center">
                            <img src="pictures/edu.png" />
                            <label>Education</label>
                        </div>
                        <div class="d-flex flex-column bg-white rounded p-5 m-5 justify-content-center">
                            <img src="pictures/money.png" />
                            <label>Income</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 p-5">
                <div class="row flex-row">
                    <div class="col-12 rounded border border-2 border-white p-3">
                        <div class="col-12">
                            <?php
                            $sub = Database::search("select * from subject");
                            $n1 = $sub->num_rows;

                            for ($x = 0; $x < $n1; $x++) {
                                $subject = $sub->fetch_assoc();
                            ?>
                                <label class="form-label text-black fs-4"><?= $subject["name"] ?></label>&nbsp;&nbsp;
                                <a href="advancedSearch.php?id=<?= $subject["id"] ?>" class="link-dark link3" style="font-size:15px ;">See All&nbsp; &rarr;</a>
                                <hr />

                                <!-- Card -->
                                <div class="col-12">
                                    <div class="row">
                                        <?php
                                        $t = Database::search("select distinct teacher_email from teacher_has_class where subject_id='" . $subject["id"] . "'");
                                        $n2 = $t->num_rows;

                                        for ($i = 0; $i < $n2; $i++) {
                                            if ($i > 3) {
                                                break;
                                            }
                                            $teacher_details = $t->fetch_assoc();
                                            $t1 = Database::search("select * from teacher where email='" . $teacher_details["teacher_email"] . "' and status='1' ");
                                            $teacher = $t1->fetch_assoc();
                                            $email = $teacher["email"];

                                        ?>
                                            <div class="col-lg-3 col-12 mt-2 row">
                                                <div class="card" style="width: 18rem;">
                                                    <div class="col-12 text-center">
                                                        <?php
                                                        $r = Database::search("select * from teacher_profile_picture where email='" . $email . "'");
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
                                                        <h5 class="card-title text-black-50"><?= $subject["name"] ?></h5>
                                                        <h5 class="card-title"><?= $teacher["first_name"] ?> <?= $teacher["last_name"] ?></h5>
                                                        <p class="card-text"><?= $teacher["degree"] ?></p>
                                                        <a href="enrollClass.php?i1=<?= $teacher["id"] ?>&&i2=<?= $subject["id"] ?>" class="btn btn-primary">More Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }

                                        ?>
                                    </div>
                                </div>
                                <!-- Card -->

                            <?php
                            }
                            ?>

                        </div>

                    </div>
                </div>
            </div>

            <?php
            require "footer.php";
            ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>