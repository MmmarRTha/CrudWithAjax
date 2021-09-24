const formularioUsuarios = document.querySelector('#usuario'),
      listadoUsuarios = document.querySelector('#listado-usuarios tbody'),
      inputBuscador = document.querySelector('#buscar');

eventListener();

function eventListener()
{
    //cuando el form de editar o crear se ejecuta
    formularioUsuarios.addEventListener('submit', leerForm);
    //listener para eliminar el boton
    listadoUsuarios.addEventListener('click', eliminarUsuario);
    //buscador
    inputBuscador.addEventListener('input', buscarUsuarios);

    numeroUsuarios();
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
            //leer el id
            const idRegistro = document.querySelector('#id').value;
            console.log(idRegistro);
            infoUsuario.append('id', idRegistro);
            actualizarRegistro(infoUsuario);
        }
    }
}
// insertar en bd via Ajax
function insertarBD(datos) {
    //crear el objeto
    const xhr = new XMLHttpRequest();

    //abrir la conexion
    xhr.open('POST', './includes/models/UsuariosCreate.php', true);

    //pasar los datos
    xhr.onload = function () {
        if (this.status === 200) {
            //leemos la respuesta de php
            const respuesta = JSON.parse( xhr.responseText);
            //insertar un nuevo elemento a la tabla
            const nuevoUsuario = document.createElement('tr');

            nuevoUsuario.innerHTML = `
            <td>${respuesta.data.name.name}</td>
            `;

            //crear contenedor para los botones
            const contenedorAcciones = document.createElement('td');
            //crear el icono de editar
            const iconoEditar = document.createElement('span');
            iconoEditar.classList.add('las', 'la-edit');
            //crear el enlace para editar
            const btnEditar = document.createElement('a');
            btnEditar.appendChild(iconoEditar);
            btnEditar.href = `update.php?id=${respuesta.data.id}`;
            btnEditar.classList.add('btn-editar', 'btn');
            //agregarlo al padre
            contenedorAcciones.appendChild(btnEditar);

            //crear el icono de eliminar
            const iconoEliminar = document.createElement('span');
            iconoEliminar.classList.add('las', 'la-trash');
            //crear el boton de eliminar
            const btnEliminar = document.createElement('button');
            btnEliminar.appendChild(iconoEliminar);
            btnEliminar.setAttribute('data-id', respuesta.data.id);
            btnEliminar.classList.add('btn-borrar', 'btn');
            //agregarlo al padre
            contenedorAcciones.appendChild(btnEliminar);
            //agregarlo al tr
            nuevoUsuario.appendChild(contenedorAcciones);
            //agregarlo con los usuarios
            listadoUsuarios.appendChild(nuevoUsuario);

            //resetear el form
            document.querySelector('form').reset();
            //mostrar notificacion
            mostrarNotificacion('Usuario creado correctamente', 'correcto');

            //actualizar numero
            numeroUsuarios();

        }
    }
    //enviar los datos
    xhr.send(datos);
}

function actualizarRegistro(datos){
    //crear el objeto
    const xhr = new XMLHttpRequest();
    //abrir la conexion
    xhr.open('POST', './includes/models/UsuariosUpdate.php', true);
    //leer la respuesta
    xhr.onload = function () {
        if(this.status === 200) {
            const respuesta = JSON.parse(xhr.responseText);
            //console.log(respuesta);
            if(respuesta.respuesta === 'correcto'){
                mostrarNotificacion('Usuario editado correctamente', 'correcto');
            }else {
                mostrarNotificacion('Hubo un error', 'error');
            }
            //despues de 4 seg redirecciona
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 4000);
        }
    }
    //enviar la petidion
    xhr.send(datos);
}

//eliminar el usuario
function eliminarUsuario(e){
    if(e.target.parentElement.classList.contains('btn-borrar')){
        //tomamos el ID
        const id = e.target.parentElement.getAttribute('data-id');
        //preguntar al usuario
        const respuesta = confirm('Estas seguro (a) que deseas eliminar el usuario?');
        if(respuesta){
            //llamado con ajax
            //crear el objeto
            const xhr = new XMLHttpRequest();
            //abrir la conexion
            xhr.open('GET', `./includes/models/UsuariosDelete.php?id=${id}&accion=borrar`, true);
            //leer la respuesta
            xhr.onload = function (){
                if(this.status === 200){
                    const resultado = JSON.parse(xhr.responseText);
                    if(resultado.respuesta === 'correcto'){
                        //eliminar registro del DOM
                        e.target.parentElement.parentElement.parentElement.remove();
                        //mostrar notificacion correcto
                        mostrarNotificacion('Usuario eliminado', 'correcto');
                        numeroUsuarios();
                    }else {
                        //mostrar notificacion error
                        mostrarNotificacion('Hubo un error!', 'error');
                    }
                }
            }
            //enviar la peticion
            xhr.send();
        }
    }
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

//busca registros
function buscarUsuarios(e) {
    const expresion = new RegExp(e.target.value, "i"),
          registros = document.querySelectorAll('tbody tr');

    registros.forEach(registro => {
        registro.style.display = 'none';
        if(registro.childNodes[1].textContent.replace(/\s/g, " ").search(expresion) != -1){
            registro.style.display = 'table-row';
        }
        numeroUsuarios();
    })
}

function numeroUsuarios(){
    const totalUsuarios = document.querySelectorAll('tbody tr');
    contenedorNumero = document.querySelector('.total-usuarios span')
    let total = 0;
    totalUsuarios.forEach(usuario => {
        if(usuario.style.display === '' || usuario.style.display === 'table-row'){
            total++
        }
    })

    console.log(total);
    contenedorNumero.textContent = total;

}