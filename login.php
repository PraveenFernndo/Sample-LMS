<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="pictures/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>

    <div class="container-fluid">
        <div class="col-12">
            <div class="col-2 offset-lg-5 d-none d-lg-block logo-image mb-5 mt-5"></div>
        </div>

        <div class="col-12 text-center">
            <span class="form-label text-black-50 fs-3">Login</span>
        </div>

        <div class="col-12 p-3">
            <div class="row">
                <div class="col-lg-8 p-3 offset-lg-2 rounded border border-3 border-white">

                    <div class="col-12">
                        <span class="form-label text-danger" id="errorDisplay"></span>
                    </div>

                    <?php

                    $email = "";
                    $password = "";

                    if (isset($_COOKIE["email"])) {
                        $email = $_COOKIE["email"];
                    }

                    if (isset($_COOKIE["password"])) {
                        $password = $_COOKIE["password"];
                    }

                    ?>

                    <div class="col-12">
                        <span class="form-label">Email</span>
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control" id="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="col-12">
                        <span class="form-label">Password</span>
                    </div>
                    <div class="col-12 d-flex form-control p-0">
                            <input type="password" class="form-control" style="border:none" id="password" value="<?php echo $password; ?>" id="password" /><i class="bi bi-eye-fill m-2 handCursor" onclick="showPassword();" id="eyeIcon"></i>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-contorl" id="rememberMe" />
                                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-decoration-underline text-primary handCursor" onclick="forgotPassword();">Forgot Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-grid mt-3">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-danger col-12" onclick="login();">Login</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-dark col-12" onclick="selectRegisterType();">New User? Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- model -->

        <div class="modal" tabindex="-1" id="fogotPasswordModel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-6">
                                <lable>New Pssword</lable>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="np">
                                </div>
                            </div>


                            <div class="col-6">
                                <lable>RE-type Pssword</lable>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="rnp">
                                </div>
                            </div>

                            <div class="col-6">
                                <lable>Verification code</lable>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="vc">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- model -->

    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>