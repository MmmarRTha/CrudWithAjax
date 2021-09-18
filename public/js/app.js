const formularioUsuarios = document.querySelector('#usuario');

eventListener();

function eventListener()
{
    //cuando el form de editar o crear se ejecuta
    formularioUsuarios.addEventListener('submit', leerForm);
}

function leerForm(e)
{
    e.preventDefault();
    //leer los datos de los inputs
    const name = document.querySelector('#name').value,
        accion = document.querySelector('#accion').value;

    if( name === ''){
        //dos parametros: texto y clase
        mostrarNotificacion('Todos los Campos son Obligatorios', 'error');
    } else {
        //pasa la validacion, crear llamado a ajax
        const infoUsuario = new FormData();
        infoUsuario.append('name', name);
        infoUsuario.append('accion', accion);

        //console.log(...infoUsuario);
        if(accion === 'create'){
            //creamos un nuevo usuario
            insertarBD(infoUsuario);
        }else{
            //editar el usuario
        }
    }
}
// insertar en bd via Ajax
function insertarBD(datos) {
    //crear el objeto
    const xhr = new XMLHttpRequest();

    //abrir la conexion
    xhr.open('POST', './includes/models/Usuarios.php', true);

    //pasar los datos
    xhr.onload = function () {
        if (this.status === 200) {
            console.log(JSON.parse( xhr.responseText));
            //leemos la respuesta de php
            const respuesta = JSON.parse( xhr.responseText);
            //insertar un nuevo elemento a la tabla
            const nuevoContacto = document.createElement('tr');

            nuevoContacto.innerHTML = `
            <td>${respuesta.name}</td>
            `;

            //crear contenedor para los botones
            const contenedorAcciones = document.createElement('td');

            //crear el icono de editar
            const iconoEditar = document.createElement('span');
            iconoEditar.classList.add('las', 'la-edit');

            //crear el enlace para editar
            const btnEditar = document.createElement('a');
            btnEditar.appendChild(iconoEditar);

        }
    }
    //enviar los datos
    xhr.send(datos);
}

//notificacion en pantalla
function mostrarNotificacion(mensaje, clase) {
    const notificacion = document.createElement('div');
    notificacion.classList.add(clase, 'notificacion', 'sombra');
    notificacion.textContent = mensaje;
    //formulario
    formularioUsuarios.insertBefore(notificacion, document.querySelector('form legend'));
    //ocultar y mostrar la notifiacion
    setTimeout(() => {
        notificacion.classList.add('visible');

        setTimeout(() => {
            notificacion.classList.remove('visible');

            setTimeout(() => {
                notificacion.remove();
            }, 500);
        }, 3000);
    }, 100);
}
