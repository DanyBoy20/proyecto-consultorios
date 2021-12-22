<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="theme-color" content="#57d6a1" />
    <meta name="msapplication-navbutton-color" content="#57d6a1" />
    <meta name="apple-mobie-web-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#57d6a1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="icon" type="image/ico" sizes="256x256"  href="Vistas/img/iconocem.ico">
    <title>CEM Vista Hermosa - ADMINISTRACIÓN </title>
    <link rel="stylesheet" href="Vistas/css/style.css" />
    <script src="Vistas/js/script.js"></script>
</head>
<body>
<div id="cuadrilla" class="grid">
    <?php
        $modulo = new Controladores\EnlacesControlador();
        $modulo->enlacesControlador();
    ?>
    <?php include 'modulos/piepagina.php'; ?>
</div>
<script src="Vistas/js/apiFetchRecibos.js" type="module"></script>
<?php include 'modulos/piefin.php'; ?> 
