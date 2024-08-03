<?php

$user_id = $_GET["i"];

require "connection.php";
session_start();

if (!empty($_SESSION["u"]) || $user_id == 0) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Favourite</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="pictures/logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-11">
                            <span class="foem-label text-black-50 fs-3 mt-3">My Favourite Classes</span>
                        </div>
                        <div class="col-1 mt-3">
                            <a href="index.php" class="btn btn-success">Home</a>
                        </div>
                    </div>
                </div>
                <div class="col-10 offset-1 border rounded border-3 p-1">
                    <div class="row p-2">

                        <?php

                        $total = 0.00;

                        if ($user_id != 0) {

                            $r2 = Database::search("select * from favourite where user_id='" . $user_id . "'");
                            $n2 = $r2->num_rows;



                            for ($x = 0; $x < $n2; $x++) {
                                $rs2 = $r2->fetch_assoc();
                                $teacher_id = $rs2["teacher_id"];

                                $r1 = Database::search("select * from teacher where id='" . $teacher_id . "'");
                                $rs1 = $r1->fetch_assoc();

                                $r3 = Database::search("select * from teacher_has_class where teacher_email='" . $rs1["email"] . "' and subject_id='" . $rs2["subject_id"] . "' and grade_id='" . $rs2["grade_id"] . "'");
                                $rs3 = $r3->fetch_assoc();

                                $r4 = Database::search("select * from subject where id='" . $rs2["subject_id"] . "' ");
                                $rs4 = $r4->fetch_assoc();

                                $r5 = Database::search("select * from grade where id='" . $rs2["grade_id"] . "' ");
                                $rs5 = $r5->fetch_assoc();

                                $r6 = Database::search("select * from medium where id='" . $rs2["medium_id"] . "' ");
                                $rs6 = $r6->fetch_assoc();

                                $r = Database::search("select * from teacher_profile_picture where email='" . $rs1["email"] . "'");
                                $n = $r->num_rows;

                        ?>
                                <div class="col-12 p-2 border-bottom">
                                    <div class="row">

                                        <div class="col-lg-1 col-12">
                                            <?php


                                            if ($n == 1) {
                                                $rs = $r->fetch_assoc();

                                            ?>
                                                <img src="<?php echo $rs["path"]; ?>" class="rounded-circle" style="width:100px;height:100px;" />
                                            <?php
                                            } else {
                                            ?>
                                                <img src="pictures/demoProfileImg.jpg" class="rounded-circle" style="width:100px;height:100px;" />
                                            <?php
                                            }

                                            ?>
                                        </div>

                                        <div class="col-lg-2 col-12 mt-4">
                                            <span><?= $rs1["first_name"] ?> <?= $rs1["last_name"] ?></span>
                                        </div>

                                        <div class="col-lg-1 col-6 mt-4">
                                            <span><?= $rs5["name"] ?></span>
                                        </div>

                                        <div class="col-lg-1 col-6 mt-4">
                                            <span><?= $rs4["name"] ?></span>
                                        </div>

                                        <div class="col-lg-1 col-6 mt-4">
                                            <span><?= $rs6["name"] ?> Medium</span>
                                        </div>

                                        <div class="col-lg-2 col-6 ps-lg-5 mt-4">
                                            <span><?= $rs3["duration"] ?></span>
                                        </div>

                                        <div class="col-lg-2 col-6 mt-4">
                                            <span>Rs. <?= $rs3["fee"] ?>.00</span>
                                        </div>
                                        <div class="col-lg-1 mt-4">
                                        <a href="paymentProcess.php?ci=<?= $rs3["id"] ?>&&ui=<?= $user_id ?>" class="btn btn-success">Pay</a>
                                        </div>
                                        <div class="col-lg-1 mt-4">
                                            <label class="btn btn-danger col-12" onclick="removeFavouriteClass('<?= $rs2['id'] ?>')">Remove</label>
                                        </div>

                                        <?php

                                        $total = $total + floatval($rs3["fee"]);

                                        ?>

                                    </div>
                                </div>



                            <?php

                            }
                        } else {

                            ?>
                            <div class="col-12 text-center ">
                                <span class="fs-4 text-black-50">No Items</span>
                            </div>
                        <?php


                        }

                        ?>


                    </div>
                </div>

            </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        alert("Login First");
        window.location = "login.php";
    </script>
<?php
}
?>