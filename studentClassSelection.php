<?php
session_start();
require "connection.php";
$r = Database::search("select * from grade where id='" . $_SESSION["u"]["grade_id"] . "'");
$grade = $r->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select a Class</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="icon" href="pictures/logo.png" />
</head>

<body class="profile">
    <div class="container-fluid">
        <div class="row">
            <div class="col-10">
                <span class="form-label text-black-50 fs-3">Teachers for <?php echo $grade["name"]; ?> Students</span>
            </div>
            <div class="col-1 mt-2">
                <span class="form-label text-black-50 handCursor text-decoration-underline"><i class="bi bi-collection-fill"></i> Collection</span>
            </div>
            <div class="col-1 mt-2">
                <span class="form-label text-black-50 handCursor text-decoration-underline"><i class="bi bi-heart-fill"></i> Watchlist</span>
            </div>
            <div class="col-12 mt-5">
                <div class="row">
                    <!-- Card -->
                    <div class="col-12 row justify-content-center">
                        <div class="card" style="width: 18rem;">
                            <div class="col-12 text-center">
                                <img class="card-img-top" src="pictures/demoProfileImg.jpg" style="width:100px;">
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title">Praveen Fernando</h5>
                                <p class="card-text">Bsc Software Engineering (UG)</p>
                                <a href="#" class="btn btn-primary col-12">Enroll Class</a>
                                <a href="#" class="btn btn-danger col-12 mt-1">Add to WishList</a>
                                <a href="#" class="btn btn-success col-12 mt-1">Add to Collection</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>