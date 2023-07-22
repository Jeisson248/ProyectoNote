<?php
include_once('../../conexion.php');
session_start();

class Usuario extends connection 
{
  private $loggedIn = false; // Estado de inicio de sesion
  private $isAdmin = false; // Estado de administrador
  private $isDocente = false; // Estado de docente

  public function __construct()
  {
    $this->bd = parent::__construct();
  }

  public function login($Usuario, $Password)
  {
    $statement = $this->bd->prepare("SELECT * FROM usuarios WHERE Usuario=:Usuario");
    $statement->execute(['Usuario' => $Usuario]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Verify the user exists and the password is correct
    if ($user && password_verify($Password, $user['PasswordUsu'])) {

      // Initialize session variables
      $_SESSION['id_usuario'] = $user['id_usuario'];
      $_SESSION['Perfil'] = $user['Perfil'];

      return true;
    }

    return false;
  }

  public function validarSesion()
  {
    if ($this->isloggedin()) {
      if (!isset($_SESSION['start'])) {
        $_SESSION['start'] = time();
      } else if (time() - $_SESSION['start'] > 60) {
        $this->cerrarSesion();
        echo "<script>alert('Cierre de sesion por inactividad');window.location='../../index.php';</script>";
      }
      $_SESSION['start'] = time();
    } else {
      // Redirect to login page if the user is not logged in
      header("Location: ../../index.php");
      exit;
    }
  }

  public function cerrarSesion()
  {
    session_unset();
    session_destroy();
  }

  public function isloggedin()
  {
    return isset($_SESSION['id_usuario']);
  }

  public function isAdmin()
  {
    return $this->isloggedin() && $_SESSION['Perfil'] === 'Administrador';
  }

  public function isDocente()
  {
    return $this->isloggedin() && $_SESSION['Perfil'] === 'Docente';
  }
}
?>
