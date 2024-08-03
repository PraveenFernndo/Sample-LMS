<?php
session_start();
require "connection.php";
if (!empty($_SESSION["t"])) {
    $total_amount = 0;
    $class_id = $_GET["ci"];
    $r = Database::search("select * from payment where class_id='" . $class_id . "' and withdraw_status='0'");
    $rn = $r->num_rows;
    for ($x = 0; $x < $rn; $x++) {
        $rs = $r->fetch_assoc();
        $total_amount = $total_amount + floatval($rs["price"]);
    }

    $service_charge = 0;
    $withdrowal_amount = 0;

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Class</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="pictures/logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    </head>

    <body>

        <div class="container-fluid">

            <div class="col-10 offset-1 mt-5 border rounded p-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold">Total Amount :</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Rs. <?= $total_amount ?>.00</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold">Service Charge :</label>
                    </div>
                    <?php
                    $service_charge = $total_amount * 0.1;
                    $withdrowal_amount = $total_amount - $service_charge;
                    ?>
                    <div class="col-6">
                        <label class="form-label">Rs. <?= $service_charge ?>.00</label>
                    </div>
                    <hr />
                    <hr />
                    <br />
                    <div class="col-6">
                        <label class="form-label fw-bold">Total Withdrowal Amount :</label>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Rs. <?= $withdrowal_amount ?>.00</label>
                    </div>
                </div>
            </div>

            <!-- payment -->

            <div class="col-lg-8 border border-dark offset-lg-2 mt-5 rounded">
                <div class="col-12">
                    <div class="row p-1">
                        <div class="col-1">
                            <img src="pictures/294654_visa_icon.png" />
                        </div>
                        <div class="col-1">
                            <img src="pictures/1156750_finance_mastercard_payment_icon (1).png" />
                        </div>
                        <div class="col-1">
                            <img src="pictures/1156727_finance_payment_paypal_icon (1).png" />
                        </div>
                    </div>
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
                        <input type="text" value="Rs. <?= $withdrowal_amount ?>.00" disabled class="form-control" />
                    </div>
                    <br />
                    <div class="col-12">
                        <label class="col-12 btn btn-primary" onclick="teacherWithdrowMoney('<?= $class_id ?>','<?= $total_amount ?>');">Withdraw</label>
                    </div>
                </div>
            </div>

            <!-- payment -->

        </div>

        <script src="script.js"></script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        alert("You can't access this area");
        window.location = "login.php";
    </script>
<?php
}
?>