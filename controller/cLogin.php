<?php
/**
 *   @author: Javier Nieto Lorenzo
 *   @since: 02/12/2020
 *   cInicio
 */
if(!isset($_COOKIE['idioma'])){
    setcookie('idioma','es',time()+2592000); // crea la cookie 'idioma' con el valor 'es' para 30 dias
    header('Location: index.php');
    exit;
}

if (isset($_REQUEST['idiomaElegido'])) { // si se ha pulsado el botton de cerrar sesion
    setcookie('idioma', $_REQUEST['idiomaElegido'], time() + 2592000); // modifica la cookie 'idioma' con el valor recibido del formulario para 30 dias
    header('Location: index.php');
    exit;
}

define("OBLIGATORIO", 1); // defino e inicializo la constante a 1 para los campos que son obligatorios

$entradaOK = true;

$aErrores = [ //declaro e inicializo el array de errores
    'CodUsuario' => null,
    'Password' => null
];


if (isset($_REQUEST["IniciarSesion"])) { // comprueba que el usuario le ha dado a al boton de IniciarSesion y valida la entrada de todos los campos
    $aErrores['CodUsuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['CodUsuario'], 15, 3, OBLIGATORIO); // comprueba que la entrada del codigo de usuario es correcta

    $aErrores['Password'] = validacionFormularios::validarPassword($_REQUEST['Password'], 8, 1, 1, OBLIGATORIO);// comprueba que la entrada del password es correcta

    if ($aErrores['CodUsuario'] != null || $aErrores['Password']!=null) { // compruebo si hay algun mensaje de error en algun campo
        $entradaOK = false; // le doy el valor false a $entradaOK
        unset($_REQUEST);
    }
} else { // si el usuario no le ha dado al boton de enviar
    $entradaOK = false; // le doy el valor false a $entradaOK
}

if ($entradaOK) { // si la entrada esta bien recojo los valores introducidos y hago su tratamiento
    $usuario = $_REQUEST['CodUsuario'];
    $password = $_REQUEST['Password'];

    $oUsuario = UsuarioPDO::validarUsuario($usuario, $password);
    if(isset($oUsuario)){ // si encuentra el usuario con el codigo de usuario y el password introducido

        $_SESSION['usuarioDAW2LoginLogoffMulticapaPOO'] = $oUsuario; // guarda en la session el objeto usuario


        UsuarioPDO::actualizarUltimaConexion($oUsuario->getCodUsuario());

        header('Location: index.php');
        exit;

    }
}

$vista = $vistas['login'];
require_once $vistas['layout'];
?> 