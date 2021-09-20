<?php
include 'includes/funciones/funciones.php';
include 'includes/layout/header.php'; ?>
<div class="contenedor-barra">
    <h1 class="titulo h1">CRUD Usuarios</h1>
</div>
<div class="bg-aqua contenedor sombra form">
    <form id="usuario" action="#">
        <legend>Alta de usuarios <span>Todos los datos son obligatorios</span>
        </legend>

<!--        formulario-->
<?php require_once 'includes/layout/form.php'; ?>

<!--contenedor resultados-->
<div class="bg-white contenedor sombra usuarios">
    <div class="contenedor-usuarios">
        <h2 class="h2">Usuarios</h2>

        <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Usuarios...">
        <p class="total-usuarios"><span>2</span> Usuarios</p>
        <div class="contenedor-tabla">
            <table id="listado-usuarios" class="listado-usuarios">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    <?php $usuarios = getUsuarios();
                    foreach($usuarios as $row) { ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->name; ?></td>
                    <td>
                        <a class="btn-editar btn" href="update.php?id=<?php echo $row->id; ?>"><span class="las la-edit"></span></a>
                        <button data-id="<?php echo $row->id; ?>" type="button" class="btn-borrar btn">
                            <span class="las la-trash"></span>
                        </button>
                    </td>
                </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'includes/layout/footer.php'; ?>
