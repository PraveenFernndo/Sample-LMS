<?php
session_start();
if (!empty($_SESSION["u"]) || !empty($_SESSION["a"])) {
    require "connection.php";

    $class_id = $_GET["ci"];
    $user_id = $_GET["ui"];
    $total = 0;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment Process</title>

        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="icon" href="pictures/logo.png" />

    </head>

    <body>

        <div class="col-12 mt-5 p-2">
            <span class="fs-3 fw-bold text-black-50">Payment Process</span>
        </div>

        <?php
        $f = Database::search("select * from teacher_has_class where id='" . $class_id . "'");
        $fs = $f->fetch_assoc();

        $r1 = Database::search("select * from teacher where email='" . $fs["teacher_email"] . "'");
        $rs1 = $r1->fetch_assoc();

        $r4 = Database::search("select * from subject where id='" . $fs["subject_id"] . "'");
        $rs4 = $r4->fetch_assoc();

        $r5 = Database::search("select * from grade where id='" . $fs["grade_id"] . "'");
        $rs5 = $r5->fetch_assoc();

        $r6 = Database::search("select * from medium where id='" . $fs["medium_id"] . "'");
        $rs6 = $r6->fetch_assoc();

        ?>

        <div class="col-12 p-2 border-bottom">
            <div class="row">

                <div class="col-lg-1 col-12">
                    <?php

                    $r = Database::search("select * from teacher_profile_picture where email='" . $fs["teacher_email"] . "'");
                    $n = $r->num_rows;

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

                <div class="col-lg-2 col-6 mt-4">
                    <span><?= $rs4["name"] ?></span>
                </div>

                <div class="col-lg-3 col-6 mt-4">
                    <span><?= $rs6["name"] ?> Medium</span>
                </div>

                <div class="col-lg-2 col-6 mt-4">
                    <span>Rs. <?= $fs["fee"] ?>.00</span>
                </div>


                <?php

                $total = $total + floatval($fs["fee"]);

                ?>


            </div>
        </div>
        <div class="col-12 text-center mt-5">
            <span class="fs-3">Total Payment : Rs. <?= $total ?>.00</span>
        </div>
        <?php
        if ($user_id == 0) {
        ?>
            <div class="col-12 text-center mt-5">
                <label class="btn btn-primary col-6">Do Payment &nbsp;&nbsp;<i class="bi bi-arrow-right-square-fill"></i></label>
            </div>


        <?php
        } else {
        ?>

            <!-- payment -->

            <div class="col-lg-8 border border-dark offset-lg-2 mt-5 rounded">
                <div class="col-12">

                </div>
                <br />
                <div class="col-12 p-2">
                    <div class="col-12">
                        <span>Account Name</span>
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control" id="accName" />
                    </div>
                    <div class="col-12">
                        <span>Bank Name</span>
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control" id="bankName" />
                    </div>
                    <div class="col-12">
                        <span>Account Number</span>
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control" id="accNum" />
                    </div>
                    <div class="col-12">
                        <span>Amount</span>
                    </div>
                    <div class="col-12">
                        <input type="text" value="Rs. <?= $total ?>.00" disabled class="form-control" />
                    </div>
                    <div class="row p-1">
                        <div class="col-1 text-center">
                            <input type="radio" class="form-check" id="visa" />
                            <img src="pictures/294654_visa_icon.png" for="visa" />
                        </div>
                        <div class="col-1 text-center">
                            <input type="radio" class="form-check" id="master" />
                            <img src="pictures/1156750_finance_mastercard_payment_icon (1).png" for="master" />
                        </div>
                        <div class="col-1 text-center">
                            <input type="radio" class="form-check" id="paypal" />
                            <img src="pictures/1156727_finance_payment_paypal_icon (1).png" for="paypal" />
                        </div>
                    </div>

                    <br />
                    <div class="col-12 text-center mt-5">
                        <label class="btn btn-primary col-6" onclick="doPayment('<?= $total ?>','<?= $class_id ?>','<?= $user_id ?>');">Do Payment &nbsp;&nbsp;<i class="bi bi-arrow-right-square-fill"></i></label>
                    </div>
                </div>
            </div>

            <!-- payment -->


        <?php
        }
        ?>

        <script src="script.js"></script>
    </body>

    </html>
<?php
}
?>