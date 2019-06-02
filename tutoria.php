<!doctype html>
<html lang="en">

<head>
	<title>DisciPart-MiTutoria</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	
	<link rel="stylesheet" href="css/style.css">
	
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="css/demo.css">
	<link rel="stylesheet" href="css/estilos.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="images/logo.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/logo.png">
</head>
<body>
<?php 
	$id = $_GET['id'];
	include('utilidades/session.php');
	
	$sql = "SELECT prof_grupo FROM profesores WHERE prof_id = $id";
                                        
    $res = mysqli_query($db, $sql);
                                        
    while ($row = mysqli_fetch_array($res)) { 
		$tutoria = $row['prof_grupo'];
	}
?>

	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="<?php echo "inicio.php?id=".$id?>"><img src="images/logo-pagina.png" alt="Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-menu"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
							<?php
								$sql = "SELECT * FROM alertas WHERE grupo = '$tutoria' AND profesor != $id";

								$res = mysqli_query($db, $sql);
								
								$count = mysqli_num_rows($res);
							?>
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger"><?php if($count > 0){echo $count;} ?></span>
							</a>
							<ul class="dropdown-menu notifications">
								<?php
								if($count > 0){
									while ($row = mysqli_fetch_array($res)) { 
										
										$sql1 = "SELECT alum_id, alum_nombre, alum_apellidos FROM alumnos WHERE alum_id = ".$row['alumno']."";
										$res1 = mysqli_query($db, $sql1);
										while ($row1 = mysqli_fetch_array($res1)){
											print '<li><a href="perfil.php?idA='.$row1['alum_id'].'&id= '.$id.' " class="notification-item"><span class="dot bg-danger"></span>'.$row1['alum_nombre'].', '.$row1['alum_apellidos'].' ha recibido un parte</a></li>';
										}
									
											
										
									}
								}
								?>
								
							</ul>
						</li>
						<li class="dropdown">
						<?php
							$sql = 'SELECT prof_nombre, prof_apellidos FROM profesores WHERE prof_id =' .$_GET['id'].'';
                                        
							$res = mysqli_query($db, $sql);
							
							while ($row = mysqli_fetch_array($res)) { 
								$avatar = $row['prof_apellidos'].", ".$row['prof_nombre'];
							}
						?>
							<a href="<?php "inicio.php?id=".$id?>" class="dropdown-toggle" data-toggle="dropdown"><img src="images/avatar.png" class="img-circle" alt="Avatar"> <span><?php echo $avatar; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="utilidades/salir.php"><i class="lnr lnr-exit"></i> <span>Salir</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="<?php echo "inicio.php?id=".$id?>" class=""><i class="lnr lnr-home"></i> <span>Inicio</span></a></li>
						<li><a href="<?php echo "tutoria.php?id=".$id?>" class="active"><i class="lnr lnr-users"></i> <span>Mi Tutoria</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Mi Tutoria</h3>
					<div class="row">
						<div class="col-md-12">
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title"></h3>
								</div>
								<div class="panel-body respon">
									<?php
									if($tutoria == "-"){
										print '<h2>Usted no tiene tutoria asignada</h2>';
									} else {
									?>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Nombre</th>
												<th>Apellidos</th>
												<th>Número de partes</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										<?php
											
												$sql = "SELECT prof_grupo FROM profesores WHERE prof_id = $id";
												
												$res = mysqli_query($db, $sql);
												
												while ($row = mysqli_fetch_array($res)) { 
													$grupoProfesor = $row['prof_grupo'];
													print '<h3>'.$grupoProfesor.'</h3>';
												}

												$sql = "SELECT alum_id, alum_nombre, alum_apellidos FROM alumnos WHERE alum_grupo = '".$grupoProfesor."'";
												
												$res = mysqli_query($db, $sql);
												
												while ($row = mysqli_fetch_array($res)) { 
													print '<tr>';
														print '<td>'.$row['alum_nombre'].'</td>';
														print '<td>'.$row['alum_apellidos'].'</td>';

														$sql1 = "SELECT count(part_alumno) as 'partes' FROM partes WHERE part_alumno = ".$row['alum_id']."";
												
														$res1 = mysqli_query($db, $sql1);
												
														while ($row1 = mysqli_fetch_array($res1)) { 
															print '<td>'.$row1['partes'].'</td>';
														}
													print '<td><a href="perfil.php?idA='.$row['alum_id'].'&id= '.$id.' ">ver perfil<a></td>';	
													print '</tr>';
												}
											}											
										?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BORDERED TABLE -->
						</div>
						
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2019 Iván Quesada Palmero</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="vendor/chartist/js/chartist.min.js"></script>
	<script src="js/klorofil-common.js"></script>
	<script>
	$(function() {
		var data, options;

		// headline charts
		data = {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			series: [
				[23, 29, 24, 40, 25, 24, 35],
				[14, 25, 18, 34, 29, 38, 44],
			]
		};

		options = {
			height: 300,
			showArea: true,
			showLine: false,
			showPoint: false,
			fullWidth: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
		};

		new Chartist.Line('#headline-chart', data, options);


		// visits trend charts
		data = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			series: [{
				name: 'series-real',
				data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
			}, {
				name: 'series-projection',
				data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
			}]
		};

		options = {
			fullWidth: true,
			lineSmooth: false,
			height: "270px",
			low: 0,
			high: 'auto',
			series: {
				'series-projection': {
					showArea: true,
					showPoint: false,
					showLine: false
				},
			},
			axisX: {
				showGrid: false,

			},
			axisY: {
				showGrid: false,
				onlyInteger: true,
				offset: 0,
			},
			chartPadding: {
				left: 20,
				right: 20
			}
		};

		new Chartist.Line('#visits-trends-chart', data, options);


		// visits chart
		data = {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			series: [
				[6384, 6342, 5437, 2764, 3958, 5068, 7654]
			]
		};

		options = {
			height: 300,
			axisX: {
				showGrid: false
			},
		};

		new Chartist.Bar('#visits-chart', data, options);


		// real-time pie chart
		var sysLoad = $('#system-load').easyPieChart({
			size: 130,
			barColor: function(percent) {
				return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
			},
			trackColor: 'rgba(245, 245, 245, 0.8)',
			scaleColor: false,
			lineWidth: 5,
			lineCap: "square",
			animate: 800
		});

		var updateInterval = 3000; // in milliseconds

		setInterval(function() {
			var randomVal;
			randomVal = getRandomInt(0, 100);

			sysLoad.data('easyPieChart').update(randomVal);
			sysLoad.find('.percent').text(randomVal);
		}, updateInterval);

		function getRandomInt(min, max) {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}

	});
	</script>
</body>

</html>
