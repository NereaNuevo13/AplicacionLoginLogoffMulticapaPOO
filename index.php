<?php 
require_once 'config/config.php';

session_start();

require_once 'config/configDB.php';
require_once 'config/lang.php';

if(isset($_SESSION['paginaEnCurso']) && $_SESSION['paginaEnCurso']!==$controladores["login"]){ // si existe la variable de sesion "paginaEnCurso" y es distinta del login 
    require_once $_SESSION['paginaEnCurso']; // incluimos el controlador que hay en la variable de sesion
} else {
    require_once $controladores["login"]; // incluimos el controlador del login
}