<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>

</head>

<body>
    <?php
      include("utilidades/bd.php");
      session_start();
      $error ="";
  if($_SERVER["REQUEST_METHOD"] == "POST") {


     $myusername = mysqli_real_escape_string($db,$_POST['usuario']);
     $mypassword = mysqli_real_escape_string($db,$_POST['contraseña']); 
     
     $sql = "SELECT id FROM credenciales WHERE usuario = '$myusername' and contraseña = '$mypassword'";
     $result = mysqli_query($db,$sql);
     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     //$active = $row['active'];
     
     $count = mysqli_num_rows($result);
     
     if($count == 1) {
        //session_register("myusername");
        $_SESSION['login_user'] = $myusername;
        
        header("location: pruebainicio.php");
        $error = "";
     }else {
        $error = "Usuario o contraseña incorrecto";
     }
  }
    ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <h5 class="card-title text-center"><img src="images/logo.png" alt="logo"></h5>
              <form class="form-signin" method="post">
                <div class="form-label-group">
                  <input type="text" id="inputUsuario" name="usuario" class="form-control" placeholder="usuario" required autofocus>
                  <label for="inputUsuario">Usuario</label>
                </div>
  
                <div class="form-label-group">
                  <input type="password" id="inputContraseña" name="contraseña" class="form-control" placeholder="Contraseña" required>
                  <label for="inputContraseña">Contraseña</label>
                </div>
  
                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Recordar Contraseña</label>
                </div>
                <p style = color:red><?php echo $error ?></p>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Acceder</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>