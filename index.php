<?php include 'includes/layout/header.php'; ?>
<div class="">
    <h1 class="titulo h1">CRUD Usuarios</h1>
</div>
<div class="">
    <form id="usuario" action="#">
        <legend>Alta de usuarios <span>Todos los datos son obligatorios</span>
        </legend>

<!--        formulario-->
<?php require_once 'includes/layout/form.php'; ?>

<!--contenedor resultados-->
<div class="">
    <div class="">
        <h2 class="h2">Usuarios</h2>

        <input type="text" id="buscar"  placeholder="Buscar Usuarios...">
        <p><span>2</span> Usuarios</p>
        <div>
            <table id="listado-usuarios">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Martha</td>
                    <td>
                        <a class="btn-editar btn" href="/usuarios/update?id=1"><span class="las la-edit"></span></a>
                        <button data-id="1" type="button" class="btn-borrar btn">
                            <span class="las la-trash"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Martha</td>
                    <td>
                        <a class="btn-editar btn" href="#"><span class="las la-edit"></span></a>
                        <button data-id="1" type="button" class="btn-borrar btn">
                            <span class="las la-trash"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Martha</td>
                    <td>
                        <a class="btn-editar btn" href="#"><span class="las la-edit"></span></a>
                        <button data-id="1" type="button" class="btn-borrar btn">
                            <span class="las la-trash"></span>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'includes/layout/footer.php'; ?>
