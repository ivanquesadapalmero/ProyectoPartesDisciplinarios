<!doctype html>
<html lang="en">

<head>
	<title>DisciPart-PerfilDeAlumno</title>
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
</head>
<body>
<?php 

	include('utilidades/session.php'); 

    $id = $_GET['id'];
    $idA = $_GET['idA'];

    $sql = "DELETE FROM alertas WHERE alumno = $idA";

    mysqli_query($db, $sql);

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
						<li><a href="<?php echo "inicio.php?id=".$id?>"><i class="lnr lnr-home"></i> <span>Inicio</span></a></li>
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
                    <?php
                        $sql = "SELECT alum_nombre, alum_apellidos, alum_grupo, alum_edad, alum_direccion, alum_telefono
                        FROM alumnos WHERE alum_id = ".$idA."";
                                        
                        $res = mysqli_query($db, $sql);
                                        
                        while ($row = mysqli_fetch_array($res)) { 
                            $nombreAlumno = $row['alum_nombre'];
                            $apellidosAlumno = $row['alum_apellidos'];
                            $grupoAlumno = $row['alum_grupo'];
                            $edadAlumno = $row['alum_edad'];
                            $direccionAlumno = $row['alum_direccion'];
                            $telefonoAlumno = $row['alum_telefono'];
	    					print '<h3 class="page-title"><b>'.$nombreAlumno.', '.$apellidosAlumno.'</b></h3>';
                        }
                    ?>
                    
                    <div class="row">
                        <div class = "col-md-6">
                            <div class ="fotoPerfil">
                                <img class="imagenPerfil" src="images/avatar.png" alt="imagen de perfil"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4><b>Edad: </b><?php echo $edadAlumno?></h4>
                            <h4><b>Dirección: </b><?php echo $direccionAlumno?></h4>
                            <h4><b>Teléfono de contacto: </b><?php echo $telefonoAlumno?></h4>
                            <h4><b>Grupo: </b><?php echo $grupoAlumno?></h4>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <div class="row">
                        <h3>Partes Recibidos</h3>
                    </div>
                    <div class="row">
                        <div class="respon col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Gravedad</th>
                                    <th>Fecha y hora de registro</th>
                                    <th>Profesor sancionador</th>
                                    <th>Motivo u observaciones</th>
                                </tr>
                                <?php

                                    $sql = "SELECT * FROM partes WHERE part_alumno = ".$idA."";
                                        
                                    $res = mysqli_query($db, $sql);
                                    $count = mysqli_num_rows($res);      
                                    $resultados = "";
                                    if($count == 0){
                                        $resultados = "No existen resultados";
                                    } else {             
                                        while ($row = mysqli_fetch_array($res)) { 
                                            
                                            
                                            $gravedad = $row['part_nivel'];
                                            $fechaHora = $row['fecha'];
                                            $profesor = $row['part_profesor'];
                                            $observaciones = $row['part_observaciones'];
                                            if($gravedad == "grave"){
                                                $color = "color-grave";
                                            } else if($gravedad == "medio"){
                                                $color = "color-medio";
                                            } else if($gravedad == "leve"){
                                                $color = "color-leve";
                                            }
                                            print '<tr>';
                                            print '<td class="'.$color.'">'.$gravedad.'</td>';
                                            print '<td>'.$fechaHora.'</td>';
                                            $sql1 = "SELECT prof_nombre, prof_apellidos FROM profesores WHERE prof_id = ".$profesor."";
                                            $res1 = mysqli_query($db, $sql1);
                                            while ($row1 = mysqli_fetch_array($res1)) { 
                                                print '<td>'.$row1['prof_apellidos'].', '.$row1['prof_nombre'].'</td>';
                                            }
                                            print '<td>'.$observaciones.'</td>';
                                            $idP = $row['part_id'];
                                            print '<td><a href="eliminar.php?idP='.$id.'&idA='.$idA.'&idPart='.$idP.'"><button class="botonEliminar" type="button" name="eliminar" id="eliminar" value = '.$idP.' >Eliminar</button></a></td>';
                                            print'</tr>';
                                            
                                        }
                                        
                                    }
                                    
                                ?>
                            </table>
                            <?php echo $resultados; ?>
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
