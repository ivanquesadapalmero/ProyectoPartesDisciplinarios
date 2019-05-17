<!doctype html>
<html lang="en">

<head>
	<title>DisciPart-Inicio</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/linearicons/style.css">
	<link rel="stylesheet" href="vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/estilos.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>
<body>
<?php 

	include('utilidades/session.php'); 
?>

	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="inicio.html"><img src="images/logo-pagina.png" alt="Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-menu"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">1</span>
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>Ivan Quesada Palmero ha recibido un parte</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="images/avatar.png" class="img-circle" alt="Avatar"> <span>Usuario</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
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
						<li><a href="inicio.php" class="active"><i class="lnr lnr-home"></i> <span>Inicio</span></a></li>
						<li><a href="tutoria.php" class=""><i class="lnr lnr-code"></i> <span>Mi Tutoria</span></a></li>
						<li><a href="charts.html" class=""><i class="lnr lnr-chart-bars"></i> <span>Charts</span></a></li>
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
					<h3 class="page-title">Inicio-Registrar un parte</h3>
					<div class="row">
						<div class="col-md-10">
						<form class="formulario">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="curso">Curso</label>
									<select id="curso" class="form-control">
										<option selected></option>
										<?php
										$sql = "SELECT DISTINCT alum_grupo FROM alumnos";
                                        
                                        $res = mysqli_query($db, $sql);
                                        
                                        while ($row = mysqli_fetch_array($res)) { 
											print '<option>'.$row['alum_grupo'].'</option>';
										}

										?>
										<!-- rellenar con cursos de la base de datos !-->
									</select>
								</div>
								<div class="form-group col-md-6">
									<label for="curso">Alumno</label>
									<select id="curso" class="form-control">
										<option selected></option>
										<!-- rellenar con cursos de la base de datos !-->
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="exampleFormControlTextarea1">Motivo u Obsevaciones</label>
									<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
								</div>	
							</div>

							<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputAddress2">Address 2</label>
								<input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
							</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
								<label for="inputCity">City</label>
								<input type="text" class="form-control" id="inputCity">
								</div>
								<div class="form-group col-md-4">
								<label for="inputState">State</label>
								<select id="inputState" class="form-control">
									<option selected>Choose...</option>
									<option>...</option>
								</select>
								</div>
								<div class="form-group col-md-2">
								<label for="inputZip">Zip</label>
								<input type="text" class="form-control" id="inputZip">
								</div>
							</div>
							<div class="form-group">
								<div class="form-check">
								<input class="form-check-input" type="checkbox" id="gridCheck">
								<label class="form-check-label" for="gridCheck">
									Check me out
								</label>
								</div>
							</div>
							<button type="submit" class="btn btn-primary">Sign in</button>
							</form>
							
						</div>
					</div>
				</div>
			</div>
			<?php mysqli_close($db);?>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2019 Iván Quesada Palmero. All Rights Reserved.</p>
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
