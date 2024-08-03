<?php
session_start();
require "connection.php";

if (!empty($_SESSION["t"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Teacher Profile</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="pictures/logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>

    <body class="profile">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 text-black-50">
                    <span class="form-label fw-bold fs-4">Teacher Profile</span>
                </div>
                <div class="col-12 text-end">
                    <a href="teacherMessage.php?i=<?= $_SESSION["t"]["id"] ?>" class="btn btn-primary">Inbox &nbsp;<i class="bi bi-envelope"></i></a>
                </div>
                <div class="col-md-2 text-center border-end">
                    <?php

                    $r = Database::search("select * from teacher_profile_picture where email='" . $_SESSION["t"]["email"] . "'");
                    $n = $r->num_rows;

                    if ($n == 1) {
                        $rs = $r->fetch_assoc();
                    ?>

                        <img src="<?php echo $rs["path"]; ?>" class="rounded-circle" style="height:200px;width:200px" id="profileImage" />
                    <?php
                    } else {
                    ?>
                        <img src="pictures/demoProfileImg.jpg" class="rounded-circle" style="height:200px;width:200px" id="profileImage" />
                    <?php
                    }

                    ?>
                    <input type="file" accept="img/*" id="profileImageUploader" class="d-none" />
                    <label class="btn btn-success" for="profileImageUploader" onclick="changeProfilePicture();">Upload Profile Image</label>
                    <div class="col-12 d-grid mt-3">
                        <a href="selectClass.php" class="btn btn-danger">Go to Class</a>
                    </div>
                    <div class="col-12 d-grid mt-3">
                        <a href="index.php" class="btn btn-primary">Back to Home</a>
                    </div>
                </div>

                <div class="col-lg-10">

                    <?php
                    $email = $_SESSION["t"]["email"];
                    $rs = Database::search("select * from teacher where email='" . $email . "'");
                    $result = $rs->fetch_assoc();

                    $r1 = Database::search("select * from gender where id='" . $result["gender_id"] . "'");
                    $gender = $r1->fetch_assoc();

                    // $grade_num = $r2->num_rows;

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
                            <input type="text" class="form-control" value="<?php echo $result["password"] ?>" disabled />
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
                            <span class="form-label">Institute</span>
                            <input type="text" class="form-control" id="institute" value="<?php echo $result["institute"] ?>" />
                        </div>
                        <div class="col-12">
                            <span class="form-label">Classes</span>
                            <input type="text" class="form-control" value="<?php

                                                                            $r5 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "'");
                                                                            $teacher_has_class_num = $r5->num_rows;

                                                                            for ($x = 0; $x < $teacher_has_class_num; $x++) {
                                                                                $rs5 = $r5->fetch_assoc();
                                                                                $r4 = Database::search("select * from subject where id='" . $rs5["subject_id"] . "'");
                                                                                $subject = $r4->fetch_assoc();
                                                                                $r2 = Database::search("select * from grade where id='" . $rs5["grade_id"] . "'");
                                                                                $grade = $r2->fetch_assoc();

                                                                                echo $grade["name"];
                                                                                echo " : ";
                                                                                echo $subject["name"];
                                                                                echo " , ";
                                                                            }

                                                                            ?>" disabled />
                        </div>

                        <div class="col-12">
                            <span class="form-label">Address</span>
                            <input type="text" class="form-control" id="address" value="<?php echo $result["address"] ?>" />
                        </div>
                        <div class="col-12">
                            <span class="form-label">Degree</span>
                            <input type="text" disabled class="form-control" id="address" value="<?php echo $result["degree"] ?>" />
                        </div>
                        <div class="col-12">
                            <span class="form-label">Description</span>
                            <textarea class="form-control" id="description"><?= $result["description"] ?></textarea>
                        </div>

                        <div class="col-12 d-grid">
                            <button class="btn btn-primary mt-3" onclick="teacherProfileUpdate();">Save Changes</button>
                        </div>

                        <div class="col-12 text-center handCursor mt-1 mb-3">
                            <a href="teacherToAdminMessage.php?i1=<?=$result["id"]?>" class="btn btn-outline-danger"><i class="bi bi-chat-dots-fill"></i> Message With Admin</a>
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
        alert("Please Login First");
        window.location = "login.php";
    </script>
<?php
}

?>