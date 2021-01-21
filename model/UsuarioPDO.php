<?php

class UsuarioPDO {

    public static function validarUsuario($codUsuario, $password) {
        $oUsuario = null; // inicializo la variable que tendrá el objeto de clase ususario en el casod e que se encuentre en la base de datos
        // comprueba que el usuario y el password introducido existen en la base de datos
        $consulta = "Select * from T01_Usuario where T01_CodUsuario=? and T01_Password=?";
        $passwordEncriptado = hash("sha256", ($codUsuario . $password)); // enctripta el password pasado como parametro
        $resultado = DBPDO::ejecutaConsulta($consulta, [$codUsuario, $passwordEncriptado]); // guardo en la variabnle resultado el resultado que me devuelve la funcion que ejecuta la consulta con los paramtros pasados por parmetro

        if ($resultado->rowCount() > 0) { // si la consulta me devuleve algun resultado
            $oUsuarioConsulta = $resultado->fetchObject(); // guardo en la variable el resultado de la consulta en forma de objeto
            // actualiza la ultima fecha de conecion
            $consultaActualizacionFechaConexion = "Update T01_Usuario set T01_NumConexiones = T01_NumConexiones+1, T01_FechaHoraUltimaConexion=? where T01_CodUsuario=?";
            $resultadoActualizacionFechaConexion = DBPDO::ejecutaConsulta($consultaActualizacionFechaConexion, [time(), $codUsuario]);

            if ($resultadoActualizacionFechaConexion) {
                // instanciacion de un objeto Usuario con los datos del usuario
                $oUsuario = new Usuario($oUsuarioConsulta->T01_CodUsuario, $oUsuarioConsulta->T01_Password, $oUsuarioConsulta->T01_DescUsuario, $oUsuarioConsulta->T01_NumConexiones + 1, $oUsuarioConsulta->T01_FechaHoraUltimaConexion, $oUsuarioConsulta->T01_Perfil, $oUsuarioConsulta->T01_ImagenUsuario);
            }
        }

        return $oUsuario;
    }

    public static function altaUsuario($codUsuario, $password, $descripcion) {
        $oUsuario = null;

        $consulta = "Insert into T01_Usuario (T01_CodUsuario, T01_DescUsuario, T01_Password , T01_NumConexiones, T01_FechaHoraUltimaConexion) values (?,?,?,1,?)";
        $resultado = DBPDO::ejecutaConsulta($consulta, [$codUsuario, $password, $descripcion, time()]);

        if ($resultado->rowCount() > 0) {
            $oUsuario = $resultado->fetchObject();
        }

        return $oUsuario;
    }

    public static function editarUsuario($descripcion, $codUsuario) {
        $oUsuario = null;
        
        $sentenciaSQL = "UPDATE T01_Usuario SET T01_DescUsuario=? WHERE T01_CodUsuario=?;";
        $resultadoSQL = DBPDO::ejecutaConsulta($sentenciaSQL, [$descripcion, $codUsuario]);
        
        if ($resultadoSQL->rowCount() > 0) {
            $oUsuario = $resultadoSQL->fetchObject();
        }
        return $oUsuario;
    }

}
