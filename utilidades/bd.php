<?php
define('DB_SERVER', 'den1.mysql4.gear.host');
define('DB_USERNAME', 'gestiondepartes');
define('DB_PASSWORD', 'Dh38?8Oh!2Uc');
define('DB_DATABASE', 'gestiondepartes');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("No se ha podido establecer la conexión con la base de datos");

$db->set_charset("utf8");



?>
