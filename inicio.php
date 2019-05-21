<!doctype html>
<html lang="en">

<head>
	<title>DisciPart-Inicio</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/estilos.css">

	<script>
    function actualizaAlumnos(grupo) {
        if (grupo == "") {
            document.getElementById("alumnos").innerHTML = "";
            document.getElementById("alumnos").disabled = true;
            return;
        } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("alumnos").innerHTML = this.responseText;
                    document.getElementById("alumnos").disabled = false;
                }
            };
            xmlhttp.open("GET","alumnoSelect.php?grupo="+grupo,true);
            xmlhttp.send();
        }
    }
    </script>
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
									<select id="curso" name="curso" class="form-control" onchange="actualizaAlumnos(this.value)" required>
										<option selected></option>
										<?php
										$sql = "SELECT DISTINCT alum_grupo FROM alumnos ORDER BY alum_grupo ASC";
                                        
                                        $res = mysqli_query($db, $sql);
                                        
                                        while ($row = mysqli_fetch_array($res)) { 
											print '<option value="' . $row['alum_grupo'] . '">'.$row['alum_grupo'].'</option>';
										}

										?>
									</select>
								</div>
								<div class="form-group col-md-6">
									<label for="alumnos">Alumno</label>
									<select id="alumnos" name="alumno" class="form-control" required>
										<option selected></option>
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="exampleFormControlTextarea1">Motivo u Obsevaciones</label>
									<textarea name="observaciones" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Nivel de Gravedad</label>
								</div>
								
							</div>

							<div class="form-row">
								<div class="custom-control custom-radio custom-control-inline col-md-4">
									<input type="radio" class="custom-control-input" id="defaultInline1" name="inlineDefaultRadiosExample" required>
									<label class="custom-control-label color-leve" for="defaultInline1">Leve</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline col-md-4">
									<input type="radio" class="custom-control-input" id="defaultInline2" name="inlineDefaultRadiosExample">
									<label class="custom-control-label color-medio" for="defaultInline2">Medio</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline col-md-4">
									<input type="radio" class="custom-control-input" id="defaultInline3" name="inlineDefaultRadiosExample">
									<label class="custom-control-label color-grave" for="grave">Grave</label>
								</div>
							</div>
							
							<div class="form-row">
								<div class="form-group col-md-4">
								</div>
								<div class="form-group col-md-4">
									<button type="submit" class="btn btn-primary">Registrar</button>
								</div>
								<div class="form-group col-md-4">
								</div>
							</div>
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
	
</body>

</html>
