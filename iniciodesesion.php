<?php
    require('conexionbd.php');
    
    if(isset($_POST['usuario']) && isset($_POST['contrasenia'])) {
        $usuario = $_POST['usuario']; 
        $contrasenia = $_POST['contrasenia'];

        $sql = "SELECT * FROM usuarios";
        $resultado = $conexion->query($sql);
        $contactos['contactos'] = array();

        while ($fila = $resultado->fetch_assoc()) {
            if($fila['nombre_de_usuario'] == $usuario && $fila['contrasenia'] == $contrasenia){
                
                session_start();
                $_SESSION['nombre_de_usuario'] = $fila['nombre_de_usuario'];
                $_SESSION['contrasenia'] = $fila['contrasenia'];
                $_SESSION['nombre'] = $fila['nombre'];
                $_SESSION['apellido'] = $fila ['apellido'];
                header("Location: index.php");
                

            }
            
        }
    
    }

    

    // $declaracion -> bind_param("ssss", $nombre, $apellido, $direccion, $correo);
   // $declaracion -> execute();


?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ----------> 
    <link href="src/styles/login.css" rel="stylesheet" id="bootstrap-css">
    
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="Imagenes/agenda.png" width="250" height="250" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="?" method="POST" >
        <input type="text" name="usuario" class="form-control" placeholder="Usuario">
        <input type="password" name="contrasenia" class="form-control" placeholder="Contraseña">
        <input type="submit" class="btn btn-primary" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>
</body>
</html>




