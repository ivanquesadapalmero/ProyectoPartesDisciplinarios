<?php
include('utilidades/session.php'); 

if (isset($_GET['grupo'])) {
    $sql = 'SELECT alum_id, alum_nombre, alum_apellidos, alum_grupo FROM alumnos WHERE alum_grupo = "' . $_GET['grupo'] . '" ORDER BY alum_grupo ASC';
    $res = mysqli_query($db, $sql);
    echo '<option value=""></option>';
    while ($alumno = mysqli_fetch_array($res)){
    echo '<option value="' . $alumno['alum_id'] . '">' . $alumno['alum_apellidos'] . ', ' . $alumno['alum_nombre'] . '</option>';
    }
} else {
    echo "";
}
?>