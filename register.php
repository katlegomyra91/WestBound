<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title>Register | WestBound Demo</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="assets/plugins/jquery-ui-1.10.4/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-3.2.0/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/default.css" rel="stylesheet" />
    <link rel="icon" type="image/jpg" href="assets/img/favicon.jpg">
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<div class="login-cover">
	    <div class="login-cover-image"><img src="assets/img/login_back.jpg" data-id="login-cover-image" alt="" /></div>
	    <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-v2 register" data-pageload-addclass="animated flipInX">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <a href="index.php"><i class="fa fa-won"></i>estBound</a>
                    <small>never miss a movie!</small>
                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
                <form action="register.php" method="POST">
                    <div class="form-group m-b-20">
                        <input type="text" name="first_name" class="form-control input-lg" placeholder="Name" />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="text" name="last_name" class="form-control input-lg" placeholder="Surname" />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="email" name="username" class="form-control input-lg" placeholder="Email Address (username)" />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" name="pass" class="form-control input-lg" placeholder="Password" />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" name="re_pass" class="form-control input-lg" placeholder="Re-password" />
                    </div>
                    <div class="login-buttons">
                        <button type="submit" name="reg_submit" class="btn btn-success btn-block btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end login -->
	</div>
	<!-- end page container -->
	
	<script src="assets/plugins/jquery-1.8.2/jquery-1.8.2.min.js"></script>
	<script src="assets/plugins/jquery-ui-1.10.4/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap-3.2.0/js/bootstrap.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="assets/js/login-v2.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
</body>
</html>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['reg_submit'])) {
			$pass = $_POST['pass'];
			$re_pass = $_POST['re_pass'];
			if (strcmp($pass, $re_pass) == 0) {
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$username = $_POST['username'];

				require 'control/class.user.php';
				$new_user = new User();
				if ($new_user->sign_up($first_name, $last_name, $username, $pass)) {
					echo "<script>alert('Your account was successfully created!');</script>";
					header("location: index.php");
				} else {
					echo "<script>alert('Error, your account couldn't be created!');</script>";
				}
			} else {
				echo "<script>alert('Error, the passwords entered don't match!');</script>";
			}			
		}
	}
?>