<?php
    require 'conexionbd.php';

    (isset($_GET['obtener-datos'])) ? obtenerDatos($conexion) : "";
    insertar($conexion);

    /* Fun */
    
    function insertar($conexion) {
        if(!isset($_GET['id'])) {
            if(!isset($_GET['nombre']) || !isset($_GET['apellido']) || !isset($_GET['direccion']) || !isset($_GET['correo']) )
                return;

            $nombre = $_GET['nombre'];
            $apellido = $_GET['apellido'];
            $direccion = $_GET['direccion'];
            $correo = $_GET['correo'];

            if(empty( $nombre ) || empty( $apellido ) || empty( $direccion ) || empty( $correo ) ) return;

            $sql= 'INSERT INTO contactos (nombre, apellido, direccion, email) VALUES (?,?,?,?)';
            $declaracion = $conexion -> prepare($sql);
            $declaracion -> bind_param("ssss", $nombre, $apellido, $direccion, $correo);
            $declaracion -> execute();
            echo 'Insertado';
        }
        else {
            if(!isset($_GET['nombre']) || !isset($_GET['apellido']) || !isset($_GET['direccion']) || !isset($_GET['correo'])){
                $id = $_GET['id'];

                $sql= 'DELETE from contactos where id = ?';
                $declaracion = $conexion -> prepare($sql);
                $declaracion -> bind_param("i", $id);
                $declaracion -> execute();
                echo 'Eliminado';

                return;
            }

            $id = $_GET['id'];
            $nombre = $_GET['nombre'];
            $apellido = $_GET['apellido'];
            $direccion = $_GET['direccion'];
            $correo = $_GET['correo'];

            if(empty( $id ) ||empty( $nombre ) || empty( $apellido ) || empty( $direccion ) || empty( $correo ) ) return;

            $sql= 'UPDATE contactos SET nombre = ?, apellido = ?, direccion = ?, email = ? WHERE id = ?';
            $declaracion = $conexion -> prepare($sql);
            $declaracion -> bind_param("ssssi", $nombre, $apellido, $direccion, $correo, $id);
            $declaracion -> execute();
            
            echo 'Modificado';
    
        }
        //header('location: index.php');
    }
    
    function obtenerDatos($conexion) {
        $sql = "SELECT * FROM contactos";
        $resultado = $conexion->query($sql);
        $contactos['contactos'] = array();

        while ($fila = $resultado->fetch_assoc()) {
             array_push($contactos['contactos'], $fila); 
            
        }
        echo json_encode($contactos);
        
    }

    function agregarNumeros() {
        if(!isset($_GET['id']) && !isset($_GET['telefonos'])) return;
        $id = $_GET['id'];
        $telefonos = explode(',', $_GET['telefono']);

        
    }


?> 