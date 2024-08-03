<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teacher</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="pictures/logo.png" />

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12">

                <div class="col-10 offset-1 border-end">
                    <div class="col-12">
                        <?php
                        require "connection.php";
                        $r = Database::search("select * from teacher_profile_picture where email='" . $_GET["e"] . "'");
                        $n = $r->num_rows;

                        if ($n == 1) {
                            $rs = $r->fetch_assoc();
                        ?>
                            <img src="<?php echo $rs["path"]; ?>" class="rounded-circle" style="height:200px;" id="profileImage" />
                        <?php
                        } else {
                        ?>
                            <img src="pictures/demoProfileImg.jpg" class="rounded-circle" style="height:250px;" id="teacherProfileImage" />
                        <?php
                        }

                        ?>
                    </div>
                    <br />
                    <br />

                    <?php
                    $t = Database::search("select * from teacher where email='" . $_GET["e"] . "'");
                    $teacher = $t->fetch_assoc();
                    ?>

                    <div class="col-12 p-2">
                        <span class="fs-5">First Name</span>
                        <input type="text" class="form-control" id="first_name" value="<?= $teacher["first_name"] ?>" />
                    </div>
                    <div class="col-12 p-2">
                        <span class="fs-5">Last Name</span>
                        <input type="text" class="form-control" id="last_name" value="<?= $teacher["last_name"] ?>" />
                    </div>
                    <div class="col-12 p-2">
                        <span class="fs-5">Teacher Id</span>
                        <input type="text" class="form-control" value="<?= $teacher["id"] ?>" />
                    </div>
                    <div class="col-12 p-2">
                        <span class="fs-5">Email</span>
                        <input type="text" class="form-control" id="email" value="<?= $teacher["email"] ?>" />
                    </div>
                    <div class="col-12 p-2">
                        <span class="fs-5">Mobile</span>
                        <input type="text" class="form-control" id="mobile" value="<?= $teacher["mobile"] ?>" />
                    </div>


                    <div class="col-12 d-grid">
                        <label class="btn btn-primary col-10 offset-1 mt-2" onclick="teacherDetailsUpdate();">Update Changes</label>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>