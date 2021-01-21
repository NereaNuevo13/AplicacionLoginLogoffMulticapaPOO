<?php

if (isset($_REQUEST['Cancelar'])) {
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del login
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['usuarioDAW2LoginLogoffMulticapaPOO'])) { // si no se ha logueado le usuario
    header('Location: index.php'); // redirige al login
    exit;
}

if (isset($_REQUEST['cerrarSesion'])) { // si se ha pulsado el boton de Cerrar Sesion
    session_destroy(); // destruye todos los datos asociados a la sesion
    header("Location: index.php"); // redirige al login
    exit;
}

$entradaOK = true;

$aErrores = [//declaro e inicializo el array de errores
    'DescUsuario' => null,
];

if (isset($_REQUEST["Aceptar"])) { // comprueba que el usuario le ha dado a al boton de IniciarSesion y valida la entrada de todos los campos
    
    $aErrores['DescUsuario'] = validacionFormularios::comprobarAlfabetico($_REQUEST['DescUsuario'], 250, 2, 1);  //maximo, mínimo y opcionalidad


    foreach ($aErrores as $campo => $error) { //Recorre el array en busca de mensajes de error
        if ($error != null) { //Si lo encuentra vacia el campo y cambia la condiccion
            $entradaOK = false; //Cambia la condiccion de la variable
        }
    }
} else {
    $entradaOK = false; //Cambiamos el valor de la variable porque no se ha pulsado el botón 
}

if ($entradaOK) { // si la entrada esta bien recojo los valores introducidos y hago su tratamiento
    
    $oUsuario = UsuarioPDO::editarUsuario($_REQUEST['DescUsuario'], $_SESSION['usuarioDAW2LoginLogoffMulticapaPOO']);
    $_SESSION['usuarioDAW2LoginLogoffMulticapaPOO'] = $oUsuario; // guarda en la session el objeto usuario
    $_SESSION['paginaEnCurso'] = $controladores['inicio']; // guardamos en la variable de sesion 'pagina' la ruta del controlador del inicio

    header('Location: index.php'); // redirige al index.php
    exit;
}

$vista = $vistas['miCuenta'];
require_once $vistas['layout'];
?>