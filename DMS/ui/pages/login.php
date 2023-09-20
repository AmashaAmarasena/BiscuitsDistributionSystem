<?php
include_once("../../class/staff.php");
$staffObject = new staff();

if (isset($_POST["st_user_name"])) {
    $staffObject->st_user_name = $_POST["st_user_name"];
    $staffObject->st_user_psswd = md5($_POST["st_user_psswd"]);

    $login_data = $staffObject->login();
    if($login_data['status']){ // redirect to dashbord after successfull login.
        header("location:dash_main.php");
    }
}
?>


<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a class="navbar-brand" href="../index.html">D M S</a></a><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <?php if(isset($login_data['status']) && $login_data['status']==false) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?php echo $login_data['message']; ?></strong>
                            <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="st_user_name" id="username" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="st_user_psswd" id="userpsswd" type="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Log in">
                </form>
            </div>
            <!--<div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Create An Account</a></div>
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
            </div>-->
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>