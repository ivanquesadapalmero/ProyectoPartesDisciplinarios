<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        include('utilidades/session.php'); 

        $idProfesor = $_GET['idP'];
        $idAlumno = $_GET['idA'];
        $idParte = $_GET['idPart'];

        $sql = 'DELETE  FROM partes WHERE part_id = '.$idParte.'';
                                        
        $res = mysqli_query($db, $sql);
        header("location:perfil.php?id=$idProfesor&idA=$idAlumno");
    ?>
</body>
</html>