<?php
	session_start();
	require '../control/class.app.php';
	$app = new App();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?php echo $_SESSION['current_user']['first_name'].' '.$_SESSION['current_user']['last_name']; ?> | Westbound Demo</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="../assets/plugins/jquery-ui-1.10.4/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap-3.2.0/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/plugins/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
	<link href="../assets/css/animate.min.css" rel="stylesheet" />
	<link href="../assets/css/style.min.css" rel="stylesheet" />
	<link href="../assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="../assets/css/default.css" rel="stylesheet" />
    <link rel="icon" type="image/jpg" href="../assets/img/favicon.jpg">
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<?php $app->header(); ?>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<?php $app->sidebar(array ("main"=>"dashboard", "sub"=>"")); ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="active"><a href="javascript:;">Home</a></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Welcome back <?php echo $_SESSION['current_user']['first_name']; ?>!</h1>
			<!-- end page-header -->
			
			<div class="row">
			    <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">List of Cinemas</h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    	$cinemas = $app->get_cinemas();
                                    	for ($i=0; $i < count($cinemas); $i++) {
                                    		echo '<tr>';
                                    		echo '<td>'.$cinemas[$i]["id"].'</td>';
                                    		echo '<td>'.$cinemas[$i]["name"].'</td>';
                                    		echo '<td class="actions"><a href="view_cinema.php?id='.$cinemas[$i]["id"].'" class="btn btn-success">view</a></td>';
                                    		echo '</tr>';
                                    	}
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
			    </div>
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<script src="../assets/plugins/jquery-1.8.2/jquery-1.8.2.min.js"></script>
	<script src="../assets/plugins/jquery-ui-1.10.4/ui/minified/jquery-ui.min.js"></script>
	<script src="../assets/plugins/bootstrap-3.2.0/js/bootstrap.min.js"></script>
	<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/plugins/jquery-cookie/jquery.cookie.js"></script>

	<script src="../assets/js/apps.min.js"></script>
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>