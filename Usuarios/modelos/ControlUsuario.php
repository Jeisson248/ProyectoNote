<?php
 if($_POST['Usuario'] =="juan" &&$_POST['Contrasena']=="1234"){
  //creador de sesion
    session_start();
    //definicion de variables
    $_SESSION['usuario']=$_POST['Usuario'];
    $_SESSION['validacion']=true;
    $_SESSION['start']=time();
    $_SESSION['expire']=$_SESSION['start']+(1*60);
    
    header("location:../../Administrador/pages/index.php");
  }else{
    echo
    "<script>
      alert('Datos incorrectos');
      window.location='../../index.php';
    </script>";
  }
?>