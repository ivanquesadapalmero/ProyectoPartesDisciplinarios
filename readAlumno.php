<?php
require_once("utilidades/bd.php");
$profesor = $_GET['profesor'];
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM alumnos WHERE alum_nombre like '%" . $_POST["keyword"] . "%' OR alum_apellidos like '%" . $_POST["keyword"] . "%' ORDER BY alum_nombre LIMIT 0,6";
$result = mysqli_query($db, $query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $alumno) {
?>
<li><?php echo '<a href="perfil.php?id='.$profesor.'&idA='.$alumno['alum_id'].'">'.$alumno["alum_nombre"].', '.$alumno['alum_apellidos'].'</a>' ?></li>
<?php } ?>
</ul>
<?php } } ?>