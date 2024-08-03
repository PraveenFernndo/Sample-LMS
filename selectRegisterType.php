<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tution || Register</title>

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

            <div class="col-12  mt-lg-0 mt-5">
                <div class="col-lg-8 offset-lg-2 mt-5 mb-5 border border-2 rounded">
                    <div class="row">

                        <div class="col-lg-6 d-grid p-3">
                            <button class="btn btn-danger" style="height:60px;" onclick="registerAsTeacher();">Regiser As a Teacher</button>
                        </div>
                        <div class="col-lg-6 d-grid p-3">
                            <button class="btn btn-dark" onclick="registerAsStudent();">Regiser As a Student</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center">
                <span class="form-label fixed-bottom">2022 Tution LK || All rights received</span>
            </div>

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>