<?php
    // INICIAR EL USO DE SESION DEL USUARIO
    session_start(); 
    
    //isset verifica que exista la variable op, posteriormente se convierte
	//todo a minúsculas
    $pagina = isset($_GET['pp'])? strtolower($_GET['pp']) : 'panelprincipal';
	//echo $pagina;
    
	//se genera la sección del menú
    require_once 'frontend/encabezado.php';

    /*en esta sección se mostrarán las páginas que van a cambiar en esta sección
	  donde $pagina tiene el nombre de la página que se va acceder, esto se hace
	  para evitar un switch-case*/	
    require_once 'frontend/' . $pagina . '.php';
	
	//se crea la sección del pie de página
    require_once 'frontend/piepagina.php';
?>