<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="pictures/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="col-2 offset-lg-5 d-none d-lg-block logo-image"></div>
            </div>
            <div class="col-12 text-center">
                <span class="form-label fs-3 text-black">Student Registration</span>
            </div>

            <div class="col-12 mt-5 mb-3">

                <div class="col-lg-6 offset-lg-3 border border-dark border-2 rounded p-2">
                    <div class="row">
                        <div class="col-12">
                            <span class="form-label text-danger" id="errorMesssage"></span>
                        </div>
                        <div class="col-lg-6">
                            <span class="form-label ">First Name</span>
                            <input type="text" class="form-control" id="firstName" />
                        </div>

                        <div class="col-lg-6">
                            <span class="form-label ">Last Name</span>
                            <input type="text" class="form-control" id="lastName" />
                        </div>
                        <div class="col-lg-6">
                            <span class="form-label ">Gender</span>
                            <select class="form-select" id="gender">

                                <option>Select</option>

                                <?php

                                require "connection.php";
                                $r = Database::search("select * from gender");
                                $n = $r->num_rows;

                                for ($x = 0; $x < $n; $x++) {
                                    $gender = $r->fetch_assoc();
                                ?>

                                    <option value="<?php echo $gender["id"]; ?>"><?php echo $gender["name"]; ?></option>

                                <?php

                                }

                                ?>



                            </select>
                        </div>
                        <div class="col-lg-6">
                            <span class="form-label ">Grade</span>
                            <select class="form-select" id="grade">
                                <option>Select</option>

                                <?php
                                $r1 = Database::search("select * from grade");
                                $n1 = $r1->num_rows;

                                for ($i = 0; $i < $n1; $i++) {

                                    $grade = $r1->fetch_assoc();
                                ?>
                                    <option value="<?php echo $grade["id"]; ?>"><?php echo $grade["name"]; ?></option>
                                <?php

                                }

                                ?>

                            </select>
                        </div>
                        <div class="col-12">
                            <span class="form-label ">Email</span>
                            <input type="text" class="form-control" id="email" />
                        </div>
                        <div class="col-lg-6">
                            <span class="form-label ">Password</span>
                            <div class="col-12 d-flex">
                                <input type="password" class="form-control" id="password" /><i class="bi bi-eye-fill m-2 handCursor" onclick="showPassword();" id="eyeIcon"></i>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <span class="form-label ">Mobile</span>
                            <input type="text" class="form-control" id="mobile" />
                        </div>
                        <div class="col-12">
                            <span class="form-label ">Address</span>
                            <input type="text" class="form-control" id="address" />
                        </div>
                        <div class="col-12">
                            <span class="form-label ">School</span>
                            <input type="text" class="form-control" id="school" />
                        </div>

                        <div class="col-lg-6 d-grid mt-3">
                            <button class="btn btn-danger" onclick="register();">Register</button>
                        </div>
                        <div class="col-lg-6 d-grid mt-3">
                            <a href="login.php" class="btn btn-dark">Already Have An Account? Login</a>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>