<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>

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
                        $t = Database::search("select * from user where email='" . $_GET["e"] . "'");
                        $student = $t->fetch_assoc();


                        $r = Database::search("select * from student_profile_picture where email='" . $_GET["e"] . "'");
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


                    <div class="col-12 p-2">
                        <span class="fs-5">Name</span>
                        <input type="text" class="form-control" id="name" value="<?= $student["first_name"] ?> <?= $student["last_name"] ?>" />
                    </div>

                    <div class="col-12 p-2">
                        <span class="fs-5">Current Grade</span>
                        <input type="text" class="form-control" value="Grade <?= $student["grade_id"] ?>" />
                    </div>

                    <div class="col-12 p-2">
                        <span class="fs-5">Update Grade</span>
                        <select class="form-select" id="grade">
                            <option>Select</option>

                            <?php

                            $r = Database::search("select * from grade");
                            $n = $r->num_rows;
                            for ($x = 0; $x < $n; $x++) {
                                $r2 = $r->fetch_assoc();
                            ?>
                                <option value="<?= $r2["id"] ?>"><?= $r2["name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-12 p-2">
                        <span class="fs-5">Student Id</span>
                        <input type="text" class="form-control" value="<?= $student["id"] ?>" />
                    </div>
                    <div class="col-12 p-2">
                        <span class="fs-5">Email</span>
                        <input type="text" class="form-control" id="email" value="<?= $student["email"] ?>" />
                    </div>
                    <div class="col-12 p-2">
                        <span class="fs-5">Mobile</span>
                        <input type="text" class="form-control" id="mobile" value="<?= $student["mobile"] ?>" />
                    </div>


                    <div class="col-12 d-grid">
                        <label class="btn btn-primary col-10 offset-1 mt-2" onclick="studentDetailsUpdate();">Update Changes</label>
                    </div>

                </div>
            </div>

            <!-- <div class="col-12 mt-5">

                <div class="col-12 text-black-50 mb-4">
                    <span class="fs-3">Assignment Marks</span>
                </div>

                <div class="col-12 mb-5">
                    <div class="row">

                        <?php

                        $r = Database::search("select * from assignment inner join teacher_assignment_upload on teacher_assignment_upload.id=assignment.teacher_assignment_upload_id where student_id='" . $student["id"] . "'");
                        $n = $r->num_rows;
                        for ($x = 0; $x < $n; $x++) {

                            $rs = $r->fetch_assoc();
                        ?>

                            <div class="col-12">
                                <span>#<?= $rs["description"] ?> :</span>&nbsp;&nbsp;&nbsp;
                                <span><?= $rs["marks"] ?></span>
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>

        </div> -->
    </div>

    <script src="script.js"></script>
</body>

</html>