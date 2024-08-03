<?php
session_start();
require "connection.php";
if (!empty($_SESSION["u"])) {

    $medium_id = $_GET["mi"];
    $grade_id = $_GET["gi"];
    $subject_id = $_GET["si"];

    $s=Database::search("select * from subject where id='".$subject_id."'");
    $sub=$s->fetch_assoc();

    $g=Database::search("select * from grade where id='".$grade_id."'");
    $grade=$g->fetch_assoc();
    
    $m=Database::search("select * from medium where id='".$medium_id."'");
    $medium=$m->fetch_assoc();

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Class</title>

        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="pictures/logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
               
                <div class="col-12">
                    <span class="fs-4 text-black-50">Class : <?=$grade["name"]?> <?=$sub["name"]?> <?=$medium["name"]?> Medium</span>
                </div>

                <!-- view lesson notes -->
                <div class="col-lg-8 offset-lg-1 mt-5 p-2">
                    <div class="col-12 mt-4 border rounded p-3">
                        <div class="row">
                            <span class="fs-4">Lesson Notes</span>

                            <?php
                            $f = Database::search("select * from student_has_class where student_id='" . $_SESSION["u"]["id"] . "'");
                            $fs = $f->fetch_assoc();
                            $r = Database::search("select * from lesson_notes where teacher_email =(select teacher_email from teacher_has_class where id='" . $fs["class_id"] . "') and subject_id='".$subject_id."' and grade_id='".$grade_id."' and medium_id='".$medium_id."'");
                            $n1 = $r->num_rows;
                            //if lesson available
                            if ($n1 > 0) {

                                for ($x = 0; $x < $n1; $x++) {
                                    $rs = $r->fetch_assoc();

                            ?>

                                    <div class="col-3 fs-5 p-2 border rounded mt-3">
                                        <div class="col-12 text-center">
                                            <span><?= $rs["description"] ?></span>
                                        </div>
                                        <!-- lesson view button -->
                                        <div class="col-12 mt-3 mb-2 text-center">
                                            <a href="<?= $rs["path"] ?>" target="blank" class="btn btn-outline-info">View Lesson Notes</a>
                                        </div>
                                    </div>

                                <?php
                                }
                                //if not available
                            } else {

                                ?>

                                <div class="col-3 fs-5 p-2 border rounded mt-3">
                                    <div class="col-12 text-center">
                                        <span>No Lessons Notes Available</span>
                                    </div>

                                </div>

                            <?php

                            }
                            ?>

                        </div>
                    </div>

                    <!-- view assignments -->

                    <div class="col-12 mt-4 border rounded p-3">
                        <div class="row">
                            <span class="fs-4">Lesson Videos</span>

                            <?php
                            $r = Database::search("select * from lesson_videos where teacher_email =(select teacher_email from teacher_has_class where id='" . $fs["class_id"] . "') and medium_id='".$medium_id."' and subject_id='".$subject_id."' and grade_id='".$grade_id."'");
                            $n1 = $r->num_rows;
                            //if video lesson available
                            if ($n1 > 0) {

                                for ($x = 0; $x < $n1; $x++) {
                                    $rs = $r->fetch_assoc();

                            ?>
                                    <div class="col-3 fs-5 p-2 border rounded mt-3">
                                        <div class="col-12 text-center">
                                            <span><?= $rs["description"] ?></span>
                                        </div>

                                        <div class="col-12 mt-3 text-center">
                                            <a href="<?= $rs["url"] ?>" class="btn btn-outline-info">GO to video</a>
                                        </div>

                                    </div>
                                <?php

                                }
                            } else {
                                ?>

                                <div class="col-3 fs-5 p-2 border rounded mt-3">
                                    <div class="col-12 text-center">
                                        <span>No Lesson Videos Available</span>
                                    </div>


                                </div>

                            <?php
                            }
                            ?>


                        </div>
                    </div>

                </div>


            </div>

            <div class="col-12 text-end fixed-bottom mb-5 mr-5 p-5">
                <a href="studentToTeacherMessage.php?i1=<?=$_SESSION["u"]["id"]?>&&i2=<?=$fs["class_id"]?>" class="text-black"><i class="bi bi-chat-dots-fill"></i> Chat With Teacher</a>
            </div>

        </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>
<?php
} else {
    echo "Please Login First";
?>
    <script>
        alert("Please Login First")
        window.location = "login.php";
    </script>
<?php
}
?>