<?php
include_once('../../conexion.php');
include_once('../modelos/Usuario.php');

if($_SERVER['REQUEST_METHOD']=== 'POST')
{
    $usuariosusu = $_POST['txtusuario'];
    $usuariosusu = $_POST['txcontrasena'];

    $usu = new Usuario();

    $usu->login($usuariosusu,$contrasena);

    //redirigir al controlador de acuerdo al rol
    if($usu->isloggedin()){
        if($usu->isAdmin()){
            header('location: ../../Administrador/pages.index.php');
        }elseif($usu->isDocen()){
            hearder('location: ../../Materias/pages/index.php');
        }
        exit();
    }else {

        print "<script>alert(\"Nombre de usuario o contraseña incorrecto\");
        window.location='../../index.php';</script>";
    }

}
?>