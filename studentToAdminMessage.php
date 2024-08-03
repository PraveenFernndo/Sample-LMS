<?php
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message To Admin</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="pictures/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 border rounded offset-lg-1 p-3 mt-5">
                <div class="row">
                    <?php
                    if (!empty($_GET["i"])) {
                        $student_id = $_GET["i"];
                        $r = Database::search("select * from user where id='" . $student_id . "'");
                        $n = $r->num_rows;
                        $rs = $r->fetch_assoc();
                        $r1 = Database::search("select * from messages where `to`='wkapraveen@gamil.com' and `from`='".$rs["email"]."' order by date_time DESC");
                        $n1 = $r1->num_rows;
                        if ($n1 > 0) {
                            for ($x = 0; $x < $n1; $x++) {
                                $rs1 = $r1->fetch_assoc();
                    ?>
                                <div class="col-12 mt-3 border rounded p-2">
                                    <span class="fw-bold">Message : </span>
                                    <span><?= $rs1["message"] ?></span><br/>
                                    <span class="fw-bold">Reply : </span>
                                    <span><?= $rs1["reply"] ?></span>
                                </div>
                        <?php
                            }
                        }
                        ?>



                    <?php
                    }
                    ?>

                </div>
            </div>

            <div class="col-lg-10 offset-lg-1">

                <!-- text -->

                <div class="col-12 mt-5">
                    <div class="row">
                        <div class="input-group">
                            <input type="text" placeholder="Type new message here..." aria-describedby="sendbtn" class="form-control rounded-0 border-0 py-3 bg-light" id="msgTxt" />
                            <button id="sendbtn" class="btn btn-link fs-2 bg-dark" onclick="messageToAdmin('<?=$rs['email']?>');">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- text -->
            </div>

        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>