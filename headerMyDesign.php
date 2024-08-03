<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-sacle=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" />
</head>

<body>

    <div class="col-12">

        <div class="row mt-1 mb-1">
            <!-- Left -->
            <div class="col-12 col-lg-4 offset-lg-1 align-self-start">
                <span class="text-lg-start label1"><b>Welcome

                        <?php
                        session_start();
                        if (isset($_SESSION["u"])) {
                            echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"];
                        } else {
                        ?>
                            <a href="index.php">Sign Up</a>
                        <?php
                        }
                        ?></b></span>

                <span class="text-lg-start lable2">Help and contact</span>
                <?php
                if (isset($_SESSION["u"])) {
                ?>
                    <span onclick="signOut();" class="text-lg-start lable2">Sign Out</span>
                <?php
                }
                ?>
            </div>
            <!-- Right -->
            <div class="col-12 col-lg-7 align-self-end" style="text-align:center;">

                <div class="row">

                    <div class="col-1 col-lg-2 offset-6">
                        <span class="text-start mt-2 lable2">Sell</span>
                    </div>
                    <div class="col-2 col-lg-1 dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownButton1" data-bs-toggle="dropdown" aria-expanded="false">My eShop</button>
                        <!-- above my shop button's id catch by below aria-labelledby -->
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">My Profile</a></li>
                            <li><a class="dropdown-item" href="#">My Selling</a></li>
                            <li><a class="dropdown-item" href="#">My Product</a></li>
                            <li><a class="dropdown-item" href="#">Wish List</a></li>
                            <li><a class="dropdown-item" href="#">Purchas History</a></li>
                            <li><a class="dropdown-item" href="#">Message</a></li>
                        </ul>

                    </div>

                    <div class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1 cart-icon"></div>

                </div>

            </div>

        </div>

    </div>

    <hr class="hr-breake-1" />

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>