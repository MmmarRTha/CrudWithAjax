<?php include 'includes/layout/header.php';

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

?>


<div class="contenedor-barra">
    <h1 class="titulo h1">Actualizar Usuarios</h1>
</div>
<div class="contenedor-volver">
    <a href="index.php" class="btn volver">Volver</a>
</div>
<div class="bg-aqua contenedor sombra form">
    <form id="usuario" action="#">


        <legend>Actualice el usuarios </legend>

<?php require_once 'includes/layout/form.php'; ?>
