<?php

class UsuarioPDO{
    public static function validarUsuario($codUsuario, $password){
        $oUsuario = null;
        
        $consulta = "Select * from T01_Usuario where T01_CodUsuario=? and T01_Password=?";
        $passwordEncriptado=hash("sha256", ($codUsuario.$password));
        $resultado = DBPDO::ejecutaConsulta($consulta, [$codUsuario,$passwordEncriptado]);
        
        if($resultado->rowCount()>0){
            $oUsuarioConsulta = $resultado->fetchObject();
            $oUsuario = new Usuario($oUsuarioConsulta->T01_CodUsuario, $oUsuarioConsulta->T01_Password, $oUsuarioConsulta->T01_DescUsuario, $oUsuarioConsulta->T01_NumConexiones, $oUsuarioConsulta->T01_FechaHoraUltimaConexion, $oUsuarioConsulta->T01_Perfil, $oUsuarioConsulta->T01_ImagenUsuario);
        }
        
        return $oUsuario;
    }
    
    public static function actualizarUltimaConexion($codUsuario) {
        $consulta = "Update T01_Usuario set T01_NumConexiones = T01_NumConexiones+1, T01_FechaHoraUltimaConexion=? where T01_CodUsuario=?";
        $resultado = DBPDO::ejecutaConsulta($consulta, [time(),$codUsuario]);
        return $resultado;
    }
    
    public static function altaUsuario($codUsuario, $password, $descripcion){
        $oUsuario = null;
        
        $consulta = "Insert into T01_Usuario (T01_CodUsuario, T01_DescUsuario, T01_Password , T01_NumConexiones, T01_FechaHoraUltimaConexion) values (?,?,?,1,?)";
        $resultado = DBPDO::ejecutaConsulta($consulta, [$codUsuario, $password, $descripcion, time()]);
        
        if($resultado->rowCount()>0){
            $oUsuario = $resultado->fetchObject();
        }
        
        return $oUsuario;
    }

}