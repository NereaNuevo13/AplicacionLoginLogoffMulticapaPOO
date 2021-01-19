<?php
/**
 *   @author: Javier Nieto Lorenzo
 *   @since: 02/12/2020
 *   Programa
*/
if(!isset($_SESSION['usuarioDAW2LoginLogoffMulticapaPOO'])){ // si no se ha logueado le usuario
    header('Location: index.php'); // redirige al login
    exit;
}

if (isset($_REQUEST['cerrarSesion'])) { // si se ha pulsado el boton de Cerrar Sesion
    session_destroy(); // destruye todos los datos asociados a la sesion
    header("Location: index.php"); // redirige al login
    exit;
}
$oUsuarioControlador = $_SESSION['usuarioDAW2LoginLogoffMulticapaPOO'];

$numConexiones = $oUsuarioControlador->getNumConexiones(); // variable que tiene el numero de conexiones sacado de la base de datos
$descUsuario = $_SESSION['usuarioDAW2LoginLogoffMulticapaPOO']->getDescUsuario(); // variable que tiene la descripcion del usuario sacado de la base de datos
$ultimaConexion = $_SESSION['usuarioDAW2LoginLogoffMulticapaPOO']->getFechaHoraUltimaConexion();
$imagenUsuario = $_SESSION['usuarioDAW2LoginLogoffMulticapaPOO']->getImagenPerfil();

$vista = $vistas['inicio'];
require_once $vistas['layout'];

?>