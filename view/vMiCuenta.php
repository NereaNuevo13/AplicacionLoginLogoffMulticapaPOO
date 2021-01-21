<?php
if(isset($_SESSION['usuarioDAW2LoginLogoffMulticapaPOO'])){
    $usuarioActual = $_SESSION['usuarioDAW2LoginLogoffMulticapaPOO'];
}
?>

<header>
    <h1 class="inicioSesion">Editar Perfil</h1>
    <div class="buttons-header-inicio">
        <!--
        <a href="detalle.php"><button class="button-inicio" name="Detalle"> <?php echo $aLang[$_COOKIE['idioma']]['details']; ?></button></a>
        <a href="editarPerfil.php"><button class="button-inicio" name="EditarPefil"> <?php echo $aLang[$_COOKIE['idioma']]['editProfile']; ?></button></a>
        -->
        <?php echo ($usuarioActual->getImagenPerfil() != null) ? '<img id="fotoPerfil" src = "data:image/png;base64,' . base64_encode($usuarioActual->getImagenPerfil()) . '" alt="Foto de perfil"/>' : "<img id='fotoPerfil' src='webroot/media/imagen_perfil2.png' alt='imagen_perfil'/>" ; ?>
        <form name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button class="logout" type="submit" name='cerrarSesion'><?php echo $aLang[$_COOKIE['idioma']]['logoff']; ?></button>
        </form>
    </div>

</header>
<main class="main-container-inicio" class="flex-container-align-item-center">
    <article class="articuloEditar">
        <label for="CodUsuario" class="labelEditar"><?php echo $aLang[$_COOKIE['idioma']]['user']; ?></label>
        <input class="required" disabled type="text" id="CodUsuario" name="CodUsuario" value="<?php echo $usuarioActual->getCodUsuario()?>">
        <br>
        <label for="DescUsuario" class="labelEditar"><?php echo $aLang[$_COOKIE['idioma']]['description']; ?></label>
        <input class="required" type="text" id="DescUsuario" name="DescUsuario" value="<?php echo $usuarioActual->getDescUsuario()?>">
        <br>
        <label for="TipoUsuario" class="labelEditar"><?php echo $aLang[$_COOKIE['idioma']]['typeUser']; ?></label>
        <input class="required" disabled type="text" id="TipoUsuario" name="TipoUsuario" value="<?php echo $usuarioActual->getPerfil()?>">
        <br>
        <label for="NumConexiones" class="labelEditar"><?php echo $aLang[$_COOKIE['idioma']]['numConn']; ?></label>
        <input class="required" disabled type="text" id="NumConexiones" name="NumConexiones" value="<?php echo $usuarioActual->getNumConexiones() ?>">
        <br>
        <label for="FechaUltimaConexion" class="labelEditar"><?php echo $aLang[$_COOKIE['idioma']]['lastConn']; ?></label>
        <input class="required" disabled type="text" id="FechaUltimaConexion" name="FechaUltimaConexion" value="<?php echo date('d/m/Y H:i:s',$usuarioActual->getFechaHoraUltimaConexion())?>">
        
    </article>
    <form name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button class="logout" id="aceptar" type="submit" name='Aceptar'><?php echo $aLang[$_COOKIE['idioma']]['accept']; ?></button>
            <button class="logout" id="cancelar" type="submit" name='Cancelar'><?php echo $aLang[$_COOKIE['idioma']]['cancel']; ?></button>
        </form>
</main>
</body>