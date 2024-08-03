<?php

require "connection.php";

$sid = $_POST["subject"];
$mid = $_POST["medium"];
$gid = $_POST["grade"];
$searchItem = $_POST["searchItem"];

$q = "select * from teacher_has_class where ";

$subject_id = 0;
$grade_id = 0;
$medium_id = 0;
$nq = 0;

if (!empty($searchItem) && $sid = "Select Subject" && $gid = "Select Grade" && $mid = "Select Medium") {
    $text = strtok($searchItem, " ");
    $q1 = Database::search("select * from teacher where first_name like '" . $text . "%' or last_name like '%" . $text . "%'");
    $nq = $q1->num_rows;


    for ($x = 0; $x < $nq; $x++) {
        $qs1 = $q1->fetch_assoc();
        $email = $qs1["email"];

        $r1 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "'");
        $rs1 = $r1->fetch_assoc();
        $n6 = $r1->num_rows;
        if ($n6 > 0) {
            for ($x = 0; $x < $n6; $x++) {

?>

                <!-- Card -->

                <div class="col-lg-3 col-12 mt-2 row ms-1">
                    <div class="card" style="width: 18rem;">
                        <div class="col-12 text-center">
                            <?php



                            $r = Database::search("select * from teacher_profile_picture where email='" . $email . "'");
                            $n = $r->num_rows;



                            $s = Database::search("select * from subject where id='" . $rs1["subject_id"] . "'");
                            $sub = $s->fetch_assoc();
                            $m = Database::search("select * from medium where id='" . $rs1["medium_id"] . "'");
                            $medium = $m->fetch_assoc();
                            $t = Database::search("select * from teacher where email='" . $rs1["teacher_email"] . "'");
                            $teacher = $t->fetch_assoc();

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
                            <h5 class="card-title text-danger">Grade <?= $rs1["grade_id"] ?></h5>
                            <h5 class="card-title text-black-50"><?= $medium["name"] ?> Medium</h5>
                            <h5 class="card-title"><?= $teacher["first_name"] ?> <?= $teacher["last_name"] ?></h5>
                            <p class="card-text"><?= $teacher["degree"] ?></p>
                            <a href="enrollClass.php?i1=<?= $teacher["id"] ?>&&i2=<?= $sub["id"] ?>" class="btn btn-primary">More Details</a>
                        </div>
                    </div>
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
        <!-- Card -->

    <?php
    }
}

$q2 = "";
if ($sid != "Select Subject") {
    if ($gid != "Select Grade" && $mid != "Select Medium") {
        $q2 = "subject_id='" . $sid . "' and grade_id='" . $gid . "' and medium_id='" . $mid . "'";
    } else if ($gid != "Select Grade") {
        $q2 = "subject_id='" . $sid . "' and grade_id='" . $gid . "'";
    } else if ($mid != "Select Medium") {
        $q2 = "subject_id='" . $sid . "' and medium_id='" . $mid . "'";
    } else {
        $q2 = "subject_id='" . $sid . "'";
    }
}
if ($gid != "Select Grade") {
    if ($sid != "Select Subject" && $mid != "Select Medium") {
        $q2 = "subject_id='" . $sid . "' and grade_id='" . $gid . "' and medium_id='" . $mid . "'";
    } else if ($sid != "Select Subject") {
        $q2 = "subject_id='" . $sid . "' and grade_id='" . $gid . "'";
    } else if ($mid != "Select Medium") {
        $q2 = "subject_id='" . $sid . "' and medium_id='" . $mid . "'";
    } else {
        $q2 = "grade_id='" . $gid . "'";
    }
}
if ($mid != "Select Medium") {
    if ($gid != "Select Grade" && $sid != "Select Subject") {
        $q2 = "subject_id='" . $sid . "' and grade_id='" . $gid . "' and medium_id='" . $mid . "'";
    } else if ($sid != "Select Subject") {
        $q2 = "subject_id='" . $sid . "' and medium_id='" . $mid . "'";
    } else if ($gid != "Select Grade") {
        $q2 = "grade_id='" . $gid . "' and medium_id='" . $mid . "'";
    } else {
        $q2 = "medium_id='" . $mid . "'";
    }
}
if (!empty($q2)) {
    $query = $q . $q2;
    $r1 = Database::search($query);

    $n1 = $r1->num_rows;

    for ($x = 0; $x < $n1; $x++) {
        $rs1 = $r1->fetch_assoc();
    ?>

        <!-- Card -->

        <div class="col-lg-3 col-12 mt-2 row ms-1">
            <div class="card" style="width: 18rem;">
                <div class="col-12 text-center">
                    <?php

                    $email = $rs1["teacher_email"];

                    $r = Database::search("select * from teacher_profile_picture where email='" . $email . "'");
                    $n = $r->num_rows;

                    $s = Database::search("select * from subject where id='" . $rs1["subject_id"] . "'");
                    $sub = $s->fetch_assoc();
                    $m = Database::search("select * from medium where id='" . $rs1["medium_id"] . "'");
                    $medium = $m->fetch_assoc();
                    $t = Database::search("select * from teacher where email='" . $rs1["teacher_email"] . "'");
                    $teacher = $t->fetch_assoc();

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
                    <h5 class="card-title text-danger">Grade <?= $rs1["grade_id"] ?></h5>
                    <h5 class="card-title text-black-50"><?= $medium["name"] ?> Medium</h5>
                    <h5 class="card-title"><?= $teacher["first_name"] ?> <?= $teacher["last_name"] ?></h5>
                    <p class="card-text"><?= $teacher["degree"] ?></p>
                    <a href="enrollClass.php?i1=<?= $teacher["id"] ?>&&i2=<?= $sub["id"] ?>" class="btn btn-primary">More Details</a>
                </div>
            </div>
        </div>

        <!-- Card -->

<?php
    }
}
