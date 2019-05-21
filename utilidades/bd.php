<?php
define('DB_SERVER', 'den1.mysql2.gear.host');
define('DB_USERNAME', 'gestiondepartes');
define('DB_PASSWORD', 'Kx1z8x?0Up~s');
define('DB_DATABASE', 'gestiondepartes');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("No se ha podido establecer la conxión con la base de datos");

$db->set_charset("utf8");



?>
