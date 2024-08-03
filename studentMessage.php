<?php
require "connection.php";
$id=$_GET["i"];

$u=Database::search("select * from user where id='".$id."'");
$us=$u->fetch_assoc();
$email=$us["email"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin to Student Messages</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="pictures/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- header tab -->

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active">
                        Inbox Messages
                    </button>

                </div>
            </nav>
            <!-- header tab -->

            <?php
            $r = Database::search("select * from messages where `to`='" . $email . "' order by date_time DESC");
            $n = $r->num_rows;

            if ($n > 0) {

            ?>


                <div class="col-lg-10 offset-lg-1 p-5 mt-5">
                    <span class="fs-5 fw-bold">Messages</span>

                    <?php
                    for ($x = 0; $x < $n; $x++) {
                        $rs = $r->fetch_assoc();

                        $r3 = Database::search("select * from teacher where email='" . $rs["from"] . "'");
                        $n3 = $r3->num_rows;

                        $first_name = "";
                        $last_name = "";
                        $status = "";

                        if ($n3 > 0) {
                            $rs3 = $r3->fetch_assoc();
                            $first_name = $rs3["first_name"];
                            $last_name = $rs3["last_name"];
                            $status = "Teacher";
                        } else {
                            $first_name = "Admin";
                            $last_name = "";
                            $status = "Admin";
                        }

                    ?>

                        <div class="col-12 border rounded p-3" style="cursor: pointer;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <span class="fw-bold"><?= $status ?></span><br />
                                    <span class="fs-5 text-black-50"><?= $rs["from"] ?> : <?= $first_name ?> <?= $last_name ?></span>
                                </div>

                                <!-- last message -->
                                <div class="col-lg-4">
                                    <span>Message : <?= $rs["message"] ?></span><br/>
                                    <span>Reply : <?= $rs["reply"] ?></span>
                                </div>
                                <div class="col-lg-2">
                                    <span> <?= $rs["date_time"] ?></span><br />
                                    <?php
                                    //seen messages
                                    if ($rs["status"] == "1") {
                                    ?>
                                        <div class="rounded-circle" id="statusDot" style="width: 10px;height:10px;background-color:green ;"></div>
                                    <?php
                                    } else {
                                        //not seen messages
                                    ?>
                                        <div class="rounded-circle" id="statusDot" style="width: 10px;height:10px;background-color:red ;"></div>
                                    <?php
                                    }
                                    ?>
                                    <a  onclick="studentViewMessages('<?= $rs['id'] ?>')" class="btn btn-primary mt-1">Reply</a>
                                </div>
                                <!-- last message -->
                            </div>
                        </div>

                <?php
                    }
                }
                ?>
                </div>

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>