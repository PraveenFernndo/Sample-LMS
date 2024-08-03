<?php
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>

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
                        $message_id = $_GET["i"];
                        $r = Database::search("select * from messages where id='".$message_id."' ");
                        $rs=$r->fetch_assoc();
                    }
                    ?>

<div class="col-12 mt-3 border rounded p-2">
    <span class="fw-bold">Message : </span>
    <span><?=$rs["message"]?></span>
</div>

<div class="col-12 mt-3 border rounded p-2">
    <span class="fw-bold">Reply : </span>
    <span><?=$rs["reply"]?></span>
</div>

                </div>
            </div>

            <div class="col-lg-10 offset-lg-1">

                <!-- text -->

                <div class="col-12 mt-5">
                    <div class="row">
                        <div class="input-group">
                            <input type="text" placeholder="Type your reply..." aria-describedby="sendbtn" class="form-control rounded-0 border-0 py-3 bg-light" id="msgTxt" />
                            <button id="sendbtn" class="btn btn-link fs-2 bg-dark" onclick="sendMsg('<?= $message_id ?>');">
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