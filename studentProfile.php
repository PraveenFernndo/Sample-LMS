<?php
session_start();
require "connection.php";

if (!empty($_SESSION["u"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Profile</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="pictures/logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>

    <body class="profile">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 text-black-50">
                    <span class="form-label fw-bold fs-4">Student Profile</span>
                </div>

                <div class="col-12 text-end">
                    <a href="studentMessage.php?i=<?=$_SESSION["u"]["id"]?>" class="btn btn-primary">Inbox &nbsp;<i class="bi bi-envelope"></i></a>
                </div>

                <div class="col-md-2 text-center border-end">
                    <?php

                    $rs = Database::search("select * from student_profile_picture where email='" . $_SESSION["u"]["email"] . "'");
                    $n = $rs->num_rows;
                    $i = $rs->fetch_assoc();

                    if ($n == 1) {
                    ?>
                        <img src="<?php echo $i["path"]; ?>" class="rounded-circle" style="height:200px;" id="profileImage" />
                    <?php
                    } else {
                    ?>
                        <img src="pictures/demoProfileImg.jpg" class="rounded-circle" style="height:200px;" id="profileImage" />
                    <?php
                    }

                    ?>
                    <input type="file" accept="img/*" id="profileImageUploader" class="d-none" />
                    <label class="btn btn-success" for="profileImageUploader" onclick="changeProfilePicture();">Upload Profile Image</label>
                    <div class="col-12 d-grid mt-3">
                        <a href="studentClasses.php" class="btn btn-danger">Find My Course</a>
                    </div>
                    <div class="col-12 d-grid mt-3">
                        <a href="index.php" class="btn btn-primary">Back to Home</a>
                    </div>
                </div>

                <div class="col-lg-10">

                    <?php
                    $email = $_SESSION["u"]["email"];
                    $rs = Database::search("select * from user where email='" . $email . "'");
                    $result = $rs->fetch_assoc();

                    $r1 = Database::search("select * from gender where id='" . $result["gender_id"] . "'");
                    $r2 = Database::search("select * from grade where id='" . $result["grade_id"] . "'");

                    $gender = $r1->fetch_assoc();
                    $grade = $r2->fetch_assoc();

                    ?>

                    <div class="row">
                        <div class="col-6">
                            <span class="form-label">First Name</span>
                            <input type="text" class="form-control" id="fname" value="<?php echo $result["first_name"] ?>" />
                        </div>
                        <div class="col-6">
                            <span class="form-label">Last Name</span>
                            <input type="text" class="form-control" id="lname" value="<?php echo $result["last_name"] ?>" />
                        </div>
                        <div class="col-12">
                            <span class="form-label">Email</span>
                            <input type="text" class="form-control" value="<?php echo $email; ?>" disabled />
                        </div>
                        <div class="col-6">
                            <span class="form-label">Password</span>
                            <div class="col-12 row">
                                <div class="col-12 d-flex">
                                    <input type="password" class="form-control" value="<?php echo $result["password"] ?>" disabled id="password" /><i class="bi bi-eye-fill m-2 handCursor" onclick="showPassword();" id="eyeIcon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <span class="form-label">Mobile</span>
                            <input type="text" class="form-control" value="<?php echo $result["mobile"] ?>" disabled />
                        </div>
                        <div class="col-6">
                            <span class="form-label">Gender</span>
                            <input type="text" class="form-control" value="<?php echo $gender["name"] ?>" disabled />
                        </div>
                        <div class="col-6">
                            <span class="form-label">Grade</span>
                            <input type="text" class="form-control" value="<?php echo $grade["name"]; ?>" disabled />
                        </div>
                        <div class="col-12">
                            <span class="form-label">Address</span>
                            <input type="text" class="form-control" id="address" value="<?php echo $result["address"] ?>" />
                        </div>
                        <div class="col-12">
                            <span class="form-label">School</span>
                            <input type="text" class="form-control" id="school" value="<?php echo $result["school"] ?>" />
                        </div>

                        <div class="col-12 d-grid">
                            <button class="btn btn-primary mt-3" onclick="studentProfileUpdate();">Save Changes</button>
                        </div>
                        <div class="col-12 text-center">
                            <a class="btn btn-outline-danger mt-5" href="studentToAdminMessage.php?i=<?=$result["id"]?>"><i class="bi bi-chat-dots-fill"></i> Chat with Admin</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 d-none d-lg-block text-center fixed-bottom">
                    <label class="form-form-label">Tution 2022 || All rights recerved</label>
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
        window.location = "login.php";
        alert("Please Login First");
    </script>
<?php
}

?>