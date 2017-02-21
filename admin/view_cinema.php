<?php
	session_start();
	require '../control/class.app.php';
	$app = new App();

	if (!isset($_GET['id']))
		header("location: index.php");

	// repel SQL Injection
	if (strpos($_GET['id'], ';') === FALSE) {
		$details = $app->get_cinema_details($_GET['id']);
	} else {
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?php echo $details['name']; ?> | Westbound Demo</title>
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
		<?php $app->sidebar(array ("main"=>"", "sub"=>"")); ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="index.php">Home</a></li>
				<li class="active"><a href="javascript:;"><?php echo $details['name']; ?></a></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><?php echo $details['name']; ?></h1>
			<!-- end page-header -->
			
			<div class="row">
			    <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">List of Movies</h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cinema Name</th>
                                        <th>Movie Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    	for ($i=0; $i < count($details['data']); $i++) {
                                    		echo '<tr>';
                                    		echo '<td>'.$details['data'][$i]["id"].'</td>';
                                    		echo '<td>'.$details['data'][$i]["cinema_name"].'</td>';
                                    		echo '<td>'.$details['data'][$i]["movie_name"].'</td>';
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