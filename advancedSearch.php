<!DOCTYPE html>
<html lang="en">

<?php

require "connection.php";
if (!empty($_GET["id"])) {
    $subjectId = $_GET["id"];
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Something Here...</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="pictures/logo.png" />
</head>

<body class="profile">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-8 offset-2 mt-4">
                <div class="col-12">
                    <div class="row">
                        <div class="col-10">
                            <input type="text" class="form-control" placeholder="Type teacher name here " id="searchItem" />
                        </div>
                        <div class="col-2">
                            <label class="btn btn-primary" onclick="select();">Search</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 mt-3">
                <div class="row">

                    <div class="col-lg-4 col-10 mt-1 offset-1 offset-lg-0">
                        <select class="form-select" id="grade" onchange="select();">
                            <option>Select Grade</option>
                            <?php

                            $r1 = Database::search("select * from grade");
                            $n1 = $r1->num_rows;
                            for ($x = 0; $x < $n1; $x++) {
                                $rs1 = $r1->fetch_assoc();
                            ?>
                                <option value="<?= $rs1['id'] ?>"><?= $rs1["name"] ?></option>
                            <?php
                            }

                            ?>

                        </select>
                    </div>

                    <div class="col-lg-4 col-10 mt-1 offset-1 offset-lg-0">
                        <select class="form-select" id="subject" onchange="select();">
                            <option>Select Subject</option>
                            <?php

                            $r2 = Database::search("select * from subject");
                            $n2 = $r2->num_rows;
                            for ($x = 0; $x < $n2; $x++) {
                                $rs2 = $r2->fetch_assoc();
                            ?>
                                <option value="<?= $rs2['id'] ?>"><?= $rs2["name"] ?></option>
                            <?php
                            }

                            ?>

                        </select>
                    </div>

                    <div class="col-lg-4 col-10 mt-1 offset-1 offset-lg-0">
                        <select class="form-select" id="medium" onchange="select();">
                            <option>Select Medium</option>
                            <?php

                            $r3 = Database::search("select * from medium");
                            $n3 = $r3->num_rows;
                            for ($x = 0; $x < $n3; $x++) {
                                $rs3 = $r3->fetch_assoc();
                            ?>
                                <option value="<?= $rs3['id'] ?>"><?= $rs3["name"] ?></option>
                            <?php
                            }

                            ?>

                        </select>
                    </div>

                    <div class="col-lg-10 p-5 offset-lg-1 mt-5 border border-5 border-black-50 rounded text-center">
                        <div class="row" id="viewArea">

                            <?php

                            if (!empty($_GET["id"])) {


                                $t = Database::search("select * from teacher_has_class where subject_id='" . $subjectId . "'");
                                $n2 = $t->num_rows;

                                if ($n2 > 0) {

                            ?>

                                    <!-- Card -->
                                    <div class="col-12">
                                        <div class="row">
                                            <?php
                                            // $t = Database::search("select * from teacher_has_class where subject_id='" . $subjectId . "'");
                                            // $n2 = $t->num_rows;

                                            $t1 = Database::search("select * from subject where id='" . $subjectId . "'");
                                            $sub = $t1->fetch_assoc();

                                            for ($i = 0; $i < $n2; $i++) {
                                                $t1 = $t->fetch_assoc();
                                                $email = $t1["teacher_email"];
                                                $medium_id = $t1["medium_id"];
                                                $grade_id = $t1["grade_id"];

                                                $t2 = Database::search("select * from teacher where email='" . $email . "'");
                                                $teacher = $t2->fetch_assoc();

                                                $t3 = Database::search("select * from medium where id='" . $medium_id . "'");
                                                $medium = $t3->fetch_assoc();
                                            ?>
                                                <div class="col-lg-3 col-12 mt-2 row ms-1">
                                                    <div class="card" style="width: 18rem;">
                                                    <div class="col-12 text-center">
                                                        <?php
                                                        $r = Database::search("select * from teacher_profile_picture where email='" . $email . "'");
                                                        $n = $r->num_rows;

                                                        if ($n == 1) {
                                                            $rs = $r->fetch_assoc();
                                                        ?>
                                                            <img src="<?php echo $rs["path"]; ?>" class="rounded-circle" style="width:100px;height:120px;" />
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img src="pictures/demoProfileImg.jpg" class="rounded-circle" style="width:100px;" />
                                                        <?php
                                                        }

                                                        ?>
                                                    </div>
                                                        <div class="card-body text-center">
                                                        <h5 class="card-title text-black-50"><?= $sub["name"] ?></h5>
                                                        <h5 class="card-title text-danger">Grade <?= $grade_id ?></h5>
                                                            <h5 class="card-title text-black-50"><?= $medium["name"] ?> Medium</h5>
                                                            <h5 class="card-title"><?= $teacher["first_name"] ?> <?= $teacher["last_name"] ?></h5>
                                                            <p class="card-text"><?= $teacher["degree"] ?></p>
                                                            <a href="enrollClass.php?i1=<?= $teacher["id"] ?>&&i2=<?=$sub["id"]?>" class="btn btn-primary">More Details</a>
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

                                } else {
                                ?>

                                    <div class="col-12">
                                        <span class="fs-1 text-black-50">No Results</span>
                                    </div>

                                <?php
                                }
                            } else {

                                ?>
                                <div class="col-12">
                                    <span class="fs-1 text-black-50">No Results</span>
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