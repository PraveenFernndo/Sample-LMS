<?php
require "connection.php";
session_start();
if (!empty($_SESSION["a"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="icon" href="pictures/logo.png" />
    </head>

    <body>

        <div class="container-fluid">
            <div class="col-12">
                <div class="row">
                    <div class="col-9">
                        <span class="form-label fs-3 text-black-50">Admin Panel</span>
                    </div>
                    <div class="col-lg-1 col-3 mt-1">
                        <a href="index.php" class="btn btn-primary">Home</a>
                    </div>
                    <div class="col-lg-2 col-3 mt-1">
                        <a href="message.php" class="btn btn-primary">Inbox &nbsp;<i class="bi bi-envelope"></i></a>
                    </div>
                    <div class="col-lg-3 mt-4 border border-3 rounded">
                        <div class="col-12">
                            <div class="col-12 text-center">
                                <span class="fw-bold">Requests For Join as a Teacher</span>
                            </div>

                            <?php

                            $r1 = Database::search("select * from teacher where status='0'");
                            $n1 = $r1->num_rows;

                            if ($n1 > 0) {

                                for ($i = 0; $i < $n1; $i++) {
                                    $rs1 = $r1->fetch_assoc();
                            ?>
                                    <div class="col-12 mt-3">
                                        <a href="teacherRequest.php?email=<?= $rs1["email"] ?>" data-value id="teacherNames" class="text-decoration-underline text-primary handCursor"><?= $rs1["first_name"] ?> <?= $rs1["last_name"] ?></a>
                                        <label><?= $rs1["class_details"] ?></label>
                                    </div>
                                <?php

                                }
                            } else {
                                ?>
                                <div class="col-12">
                                    <span class="text-black-50 fs-4">No Requests available</span>
                                </div>
                            <?php
                            }

                            ?>
                        </div>

                        <div class="col-12 border-top">

                            <div class="col-12">
                                <div class="col-12 text-center">
                                    <span class="fw-bold">Rejected Requests</span>
                                </div>

                                <?php

                                $r1 = Database::search("select * from teacher where status='2'");
                                $n1 = $r1->num_rows;
                                if ($n1 > 0) {
                                    for ($i = 0; $i < $n1; $i++) {
                                        $rs1 = $r1->fetch_assoc();
                                ?>
                                        <div class="col-12 mt-3">
                                            <a href="teacherRequest.php?email=<?= $rs1["email"] ?>" data-value id="teacherNames" class="text-decoration-underline text-primary handCursor"><?= $rs1["first_name"] ?> <?= $rs1["last_name"] ?></a>
                                            <label><?= $rs1["class_details"] ?></label>
                                        </div>
                                    <?php

                                    }
                                } else {
                                    ?>
                                    <div class="col-12">
                                        <span class="text-black-50 fs-4">No Rejects</span>
                                    </div>
                                <?php
                                }

                                ?>
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-3 mt-4 border border-3 rounded">
                        <div class="row">
                            <div class="col-12 text-center">
                                <span class="fw-bold">Students</span>
                            </div>
                            <?php
                            $r2 = Database::search("select * from user");
                            $n2 = $r2->num_rows;
                            for ($x = 0; $x < $n2; $x++) {
                                $rs2 = $r2->fetch_assoc();
                            ?>
                                <div class="col-10 mt-3 border rounded">
                                    <a href="student.php?email=<?= $rs2["email"] ?>"><?= $rs2["first_name"] ?> <?= $rs2["last_name"] ?> : Grade <?= $rs2["grade_id"] ?> <br /> email : <?= $rs2["email"] ?></a>
                                </div>
                                <div class="col-2 mt-3">
                                    <a href="sendMessageToStudent.php?i=<?= $rs2["id"] ?>"><i class="bi bi-chat-dots-fill"></i></a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-4 border border-3 rounded">
                        <div class="row">
                            <div class="col-12 text-center">
                                <span class="fw-bold">Teachers</span>
                            </div>
                            <?php
                            $r2 = Database::search("select * from teacher where status='1'");
                            $n2 = $r2->num_rows;
                            for ($x = 0; $x < $n2; $x++) {
                                $rs2 = $r2->fetch_assoc();
                            ?>
                                <div class="col-10 mt-3">
                                    <a href="TeacherRequest.php?email=<?= $rs2["email"] ?>"><?= $rs2["first_name"] ?> <?= $rs2["last_name"] ?> : <?= $rs2["email"] ?></a>
                                </div>
                                <div class="col-2 mt-3">
                                    <a href="sendMessageToTeacher.php?i=<?= $rs2["id"] ?>"><i class="bi bi-chat-dots-fill"></i></a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-lg-3 mt-4 border border-3 rounded">
                        <div class="col-10 offset-1 border rounded mt-5 p-2">
                            <span>Add New Subject </span>
                            <input type="text" class="form-control" id="subName" />
                            <div class="col-8 offset-2 d-grid mt-1">
                                <button class="btn btn-primary" onclick="addNewSubject();">Add</button>
                            </div>
                        </div>

                        <div class="col-10 offset-1 border rounded mt-2 p-2">
                            <span>Add New Grade </span>
                            <input type="text" class="form-control" id="new_grade" />
                            <div class="col-8 offset-2 d-grid mt-1">
                                <button class="btn btn-primary" onclick="addNewGrade();">Add</button>
                            </div>
                        </div>

                        <div class="col-10 offset-1 border rounded mt-2 p-2">
                            <span>Add Latest News </span>
                            <textarea class="form-control" id="news"></textarea>
                            <div class="col-8 offset-2 d-grid mt-1">
                                <button class="btn btn-success" onclick="addNewNews();">Add New</button>
                                <button class="btn btn-danger mt-1" onclick="removeNews();">Remove All</button>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <?php
                            $r3 = Database::search("select count(id) from user");
                            $rs3 = $r3->fetch_assoc();
                            ?>
                            <span>Total Registered Students : <?= $rs3["count(id)"] ?></span>
                        </div>
                        <div class="col-12 mt-3">
                            <?php
                            $r4 = Database::search("select count(id) from teacher where status='1'");
                            $rs4 = $r4->fetch_assoc();
                            ?>
                            <span>Total Approved Teachers : <?= $rs4["count(id)"] ?></span>
                        </div>
                        <?php
                        $income = 0;
                        $sc = Database::search("select * from teacher_withdraw");
                        $sn = $sc->num_rows;
                        for ($x = 0; $x < $sn; $x++) {
                            $scs = $sc->fetch_assoc();
                            $income = $income + floatval($scs["service_charges"]);
                        }
                        ?>
                        <div class="col-12 mt-3">
                            <span>Total Income : Rs. <?= $income ?>.00 </span>
                        </div>
                    </div>


                    <!-- manage Teachers and students -->

                    <!-- manage teacher details -->

                    <div class="col-lg-6 offset-0 offset-lg-3 border rounded p-3 mt-3">
                        <div class="row">

                            <div class="col-12 text-center">
                                <span class="fs-4">Manage Teacher</span>
                                <a href="adminPanel.php" class="text-info text-decoration-underline" style="font-size: 15px;cursor: pointer;">reload</a>
                            </div>

                            <div class="col-12">
                                <span>Teacher Email</span>
                                <input type="text" class="form-control" id="teacherEmail" />
                                <label class="btn btn-success col-8 offset-2 fs-5 mt-2" onclick="adminManageTeacher();">Check</label>
                            </div>

                            <?php
                            //search teacher details
                            if (!empty($_GET["email"])) {
                                $email = $_GET["email"];
                                $t = Database::search("select * from teacher where email='" . $email . "'");
                                $n = $t->num_rows;
                                $tr = $t->fetch_assoc();
                                //if particular email available in database
                                if ($n == 1) {
                            ?>

                                    <div class="col-12 mt-1 ">
                                        <span class="fs-5"><?= $tr["first_name"] ?> <?= $tr["last_name"] ?></span>&nbsp;&nbsp;
                                        <a href="manageTeacher.php?e=<?= $email ?>" style="font-size: 15px;" class="text-decoration-underline text-info">edit details</a>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <div class="col-10">
                                            <div class="row">
                                                <?php
                                                //search teacher class details
                                                $thc = Database::search("select * from teacher_has_class where teacher_email='" . $email . "'");
                                                $thcn = $thc->num_rows;
                                                for ($x = 0; $x < $thcn; $x++) {
                                                    $teacher = $thc->fetch_assoc();
                                                    //search grade and subject
                                                    $g = Database::search("select * from grade where id='" . $teacher["grade_id"] . "'");
                                                    $grade = $g->fetch_assoc();
                                                    $s = Database::search("select * from subject where id='" . $teacher["subject_id"] . "'");
                                                    $subject = $s->fetch_assoc();

                                                ?>
                                                    <span class="col-8"><?= $grade["name"] ?> : <?= $subject["name"] ?></span><br />
                                                    <div class="col-4">
                                                        <span class="text-primary text-decoration-underline" style="cursor:pointer" onclick="removeClass('<?= $email ?>','<?= $grade['id'] ?>','<?= $subject['id'] ?>');">Remove Class</span>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>

                                <?php
                                    //if not available email
                                } else {
                                ?>

                                    <div class="col-12 mt-1 ">
                                        <span class="fs-5">No Data Available</span>&nbsp;&nbsp;
                                        <a href="#" style="font-size: 15px;" class="text-decoration-underline text-info">edit details</a>
                                    </div>


                                <?php
                                }
                            } else {
                                //before search email view
                                ?>
                                <div class="col-12 mt-1 ">
                                    <span class="fs-5 text-danger">Enter Email</span>&nbsp;&nbsp;
                                    <a href="#" style="font-size: 15px;" class="text-decoration-underline text-info">edit details</a>
                                </div>

                            <?php
                            }

                            ?>



                        </div>
                    </div>
                    <!-- assign classes for teacher -->

                    <div class="col-lg-6 offset-0 offset-lg-3 mt-2 border rounded p-3">
                        <div class="col-12 text-center">
                            <span class="fs-4 text-black-50">Add new class to teacher</span>
                        </div>


                        <div class="row  border border-dark rounded p-2">

                            <div class="col-12">
                                <div class="col-12">
                                    <span>Grade</span>
                                </div>
                                <select id="teacherGrade" class="form-select">
                                    <option>Select</option>
                                    <?php
                                    $r3 = Database::search("select * from grade");
                                    $n3 = $r3->num_rows;
                                    for ($x = 0; $x < $n3; $x++) {
                                        $rs3 = $r3->fetch_assoc();
                                    ?>
                                        <option value="<?= $rs3["id"] ?>"><?= $rs3["name"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <div class="col-12">
                                    <span>Subject</span>
                                </div>
                                <select id="teacherSubject" class="form-select">
                                    <option>Select</option>
                                    <?php
                                    $r3 = Database::search("select * from subject");
                                    $n3 = $r3->num_rows;
                                    for ($x = 0; $x < $n3; $x++) {
                                        $rs3 = $r3->fetch_assoc();
                                    ?>
                                        <option value="<?= $rs3["id"] ?>"><?= $rs3["name"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <div class="col-12">
                                    <span>Medium</span>
                                </div>
                                <select id="teacherMedium" class="form-select">
                                    <option>Select</option>
                                    <?php
                                    $r3 = Database::search("select * from medium");
                                    $n3 = $r3->num_rows;
                                    for ($x = 0; $x < $n3; $x++) {
                                        $rs3 = $r3->fetch_assoc();
                                    ?>
                                        <option value="<?= $rs3["id"] ?>"><?= $rs3["name"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-6">
                                <div class="col-12">
                                    <span>Fees</span>
                                </div>

                                <div class="col-12">
                                    <input type="text" class="form-control" id="fees" />
                                </div>

                            </div>

                            <div class="col-6">
                                <div class="col-12">
                                    <span>Duration</span>
                                </div>

                                <div class="col-12">
                                    <input type="text" class="form-control" id="duration" />
                                </div>

                            </div>

                            <div class="col-12 mt-2">
                                <label class="btn btn-primary col-12" onclick="addClassToTeacher('<?= $email ?>');">Add Class</label>
                            </div>

                            <?php
                            if (!empty($email)) {
                                $r3 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "'");
                                $n3 = $r3->num_rows;
                                if ($n3 > 0) {
                                    for ($x = 0; $x < $n3; $x++) {
                                        $rs3 = $r3->fetch_assoc();

                                        $r4 = Database::search("select * from subject where id='" . $rs3["subject_id"] . "'");
                                        $rs4 = $r4->fetch_assoc();


                                        $r5 = Database::search("select * from medium where id='" . $rs3["medium_id"] . "'");
                                        $rs5 = $r5->fetch_assoc();
                            ?>
                                        <div class="col-12 text-black-50">
                                            <div class="row">
                                                <div class="col-2">
                                                    <span><?= $rs4["name"] ?></span>
                                                </div>
                                                <div class="col-2">
                                                    <span>Grade <?= $rs3["grade_id"] ?></span>
                                                </div>
                                                <div class="col-3">
                                                    <span><?= $rs5["name"] ?> Medium</span>
                                                </div>
                                                <div class="col-2">
                                                    <span>Rs.<?= $rs3["fee"] ?></span>
                                                </div>
                                                <div class="col-3">
                                                    <span><?= $rs3["duration"] ?></span>
                                                </div>
                                            </div>
                                        </div>

                            <?php
                                    }
                                }
                            }
                            ?>

                        </div>
                    </div>

                    <!-- manage teacher details -->


                    <!-- manage student details -->

                    <div class="col-lg-6 offset-0 offset-lg-3 border rounded p-3 mt-3 mb-5">
                        <div class="row">

                            <div class="col-12 text-center">
                                <span class="fs-4">Manage Student</span>
                                <a href="adminPanel.php" class="text-info text-decoration-underline" style="font-size: 15px;cursor: pointer;">reload</a>
                            </div>

                            <div class="col-12">
                                <span>Student Email</span>
                                <input type="text" class="form-control" id="student_email" />
                                <label class="btn btn-danger col-8 offset-2 fs-5 mt-2" onclick="adminManageStudent();">Check</label>
                            </div>

                            <?php
                            //check if email input area is empty
                            if (!empty($_GET["se"])) {
                                $student_email = $_GET["se"];
                                $sr = Database::search("select * from user where email='" . $student_email . "'");
                                $srn = $sr->num_rows;
                                //check if that email available in database
                                if ($srn > 0) {
                                    $srd = $sr->fetch_assoc();

                            ?>

                                    <div class="col-12 mt-1 ">
                                        <span class="fs-5"><?= $srd["first_name"] ?> <?= $srd["last_name"] ?></span>&nbsp;&nbsp;
                                        <a href="studentDetails.php?e=<?= $srd["email"] ?>" style="font-size: 15px;" class="text-decoration-underline text-info">more details</a>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <div class="row">
                                            <div class="col-10">
                                                <span class="fs-5">Grade <?= $srd["grade_id"] ?></span><br />
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>

                                    <div class="col-12 mt-1 ">
                                        <span class="fs-5">Student Name</span>&nbsp;&nbsp;
                                        <a href="#" style="font-size: 15px;" class="text-decoration-underline text-info">more details</a>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <div class="row">
                                            <div class="col-10">
                                                <span class="fs-5">Grade</span><br />
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                            } else {
                                ?>

                                <div class="col-12 mt-1 ">
                                    <span class="fs-5">Student Name</span>&nbsp;&nbsp;
                                    <a href="#" style="font-size: 15px;" class="text-decoration-underline text-info">more details</a>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="row">
                                        <div class="col-10">
                                            <span class="fs-5">Grade</span><br />
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <hr class="mt-3" />

                    <!-- manage student details -->

                    <!-- manage Teachers and students -->


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