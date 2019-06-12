<!doctype html>
<html lang="en">

<head>
	<title>DisciPart-Inicio</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="apple-touch-icon" sizes="76x76" href="images/logo.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/logo.png">
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
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
	<?php print 'var profesor='.$_GET['id'].';' ?>
	$(document).ready(function(){
		$("#search-box").keyup(function(){
			$.ajax({
			type: "POST",
			url: "readAlumno.php?profesor="+profesor,
			data:'keyword='+$(this).val(),
			beforeSend: function(){
				$("#search-box").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
			},
			success: function(data){
				$("#suggesstion-box").show();
				$("#suggesstion-box").html(data);
				$("#search-box").css("background","#FFF");
			}
			});
		});
	});
    </script>
</head>
<body>
<?php 

	include('utilidades/session.php'); 

	$id = $_GET['id'];

	$registrado = "";
	if(isset($_POST['registrar'])){

		$profesor = $id;
		$alumno = $_POST['alumno'];
		$observaciones = $_POST['observaciones'];
		$gravedad = $_POST['gravedad'];
		$fecha = date('d/m/Y g:ia');
		$grupo = $_POST['curso'];

		$sql = "INSERT INTO partes (part_nivel, part_observaciones, part_alumno, part_profesor, fecha) VALUES('$gravedad','$observaciones','$alumno','$profesor','$fecha')";
		  
		if (mysqli_query($db, $sql)) {
			$registrado = "Parte registrado correctamente";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}

		$sql1 = "INSERT INTO alertas (grupo, alumno, profesor) VALUES('$grupo', '$alumno', '$profesor')";
		mysqli_query($db, $sql1);
		
	}

	$sql = "SELECT prof_grupo FROM profesores WHERE prof_id = $id";

	$res = mysqli_query($db, $sql);
                                        
	while ($row = mysqli_fetch_array($res)) { 
		$grupo = $row['prof_grupo'];
	}

	


?>

	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			
			<div class="container-fluid">
			<div class="brand">
				<a href="<?php echo "inicio.php?id=".$id?>"><img src="images/logo-pagina.png" alt="Logo" class="img-responsive logo"></a>
			</div>
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-menu"></i></button>
				</div>

				<div class="frmSearch">
					<input type="text" id="search-box" placeholder="Buscar Alumno" />
					<div id="suggesstion-box"></div>
				</div>

				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<?php
								$sql = "SELECT * FROM alertas WHERE grupo = '$grupo' AND profesor != $id";

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
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="images/avatar.png" class="img-circle" alt="Avatar"> <span><?php echo $avatar ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
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
						<li><a href="<?php echo "inicio.php?id=".$id?>" class="active"><i class="lnr lnr-home"></i> <span>Inicio</span></a></li>
						<li><a href="<?php echo "tutoria.php?id=".$id?>"><i class="lnr lnr-users"></i> <span>Mi Tutoria</span></a></li>
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
						<form class="formulario" method="POST" action="">
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
								<div class="custom-control custom-radio custom-control-inline col-md-6">
									<input type="radio" class="custom-control-input" value="leve" id="defaultInline1" name="gravedad" required>
									<label class="custom-control-label color-medio" for="defaultInline1">Leve</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline col-md-6">
									<input type="radio" class="custom-control-input" value="grave" id="defaultInline3" name="gravedad">
									<label class="custom-control-label color-grave" for="grave">Grave</label>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
								</div>
								<div class="form-group col-md-4">
									<button type="submit" name="registrar" class="btn btn-primary">Registrar</button>
								</div>
								<div class="form-group col-md-4">
								</div>
							</div>
							</form>
						
							
						</div>
						
					</div>
					<p style="color:green"><?php echo $registrado?></p>
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
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slimscroll.min.js"></script>
	<script src="js/jquery.easypiechart.min.js"></script>
	<script src="js/chartist.min.js"></script>
	<script src="js/klorofil-common.js"></script>
	
</body>

</html>
