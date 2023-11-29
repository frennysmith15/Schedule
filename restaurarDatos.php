<?php
   $host = 'localhost';
   $usuario = 'root';
   $password = '';
   $base_de_datos = "agenda";
   
   $mysqli = new mysqli($host, $usuario, $password, $base_de_datos);
   
   if(! $mysqli ) {
      die( 'No se pudoconectar. ' . $mysqli->error );
   }

   $sql = file_get_contents("backup.sql");
   $mysqli->query("DELETE FROM `contactos`");

   $valorDeRetorno = $mysqli->query( $sql );
   
   if(! $valorDeRetorno ) {
      die('No se pudieron cargar los datos: ' . $mysqli->error);
   }
   
   $mysqli->close();
   header("Location: index.php");
?>