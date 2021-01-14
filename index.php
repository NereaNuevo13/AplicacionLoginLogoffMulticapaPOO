<?php 
require_once 'config/config.php';

session_start();

require_once 'config/configDB.php';
require_once 'config/lang.php';

if (isset($_SESSION["usuarioDAW2LoginLogoffMulticapaPOO"])){
    require_once $controladores["inicio"];
} else {
    require_once $controladores["login"];
}