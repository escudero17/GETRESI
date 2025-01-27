// Te muestra las características de la categoría 
function fShowForm(elemento, id_cat_resi) {

    
    document.querySelector("#imagenes").style.display = "none";

    // Vaciamos el contenedor de características
    document.querySelector("#caracteristicas").style.display = "block";

    // Vaciamos el contenedor de preguntas
    document.querySelector("#preguntas").style.display = "none";

    // Vaciamos el contenedor del formulario de las fotos y vídeos
    document.querySelector("#file-form").style.display = "none";

    document.querySelector(".cerrarFto").style.display="none";

    document.querySelector("#botonera-habitacion").style.display="none";
    if (id_cat_resi === 5) {
        // Si la categoría seleccionada es la categoría 5, no se agregan características
        return;
    }

    let caracteristicasData = elemento.parentNode.getAttribute('data-caracteristicas');
    let caracteristicas = JSON.parse(caracteristicasData);
    
    let residenciaCaracteristicasData = elemento.parentNode.getAttribute('data-residencia-caracteristicas');
    let residenciaCaracteristicas = JSON.parse(residenciaCaracteristicasData);

let html = "";
    caracteristicas.forEach(caracteristica => {
        if (caracteristica.id_cat_resi === id_cat_resi) {
            html += '<div class="checkbox-apple">';
            html += '<input class="yep" id="' + caracteristica.id_caracteristica + '" type="checkbox" value="' + caracteristica.id_caracteristica + '" name="' + caracteristica.id_caracteristica + '"';
            if (residenciaCaracteristicas.includes(caracteristica.id_caracteristica)) {
                html += ' checked';
            }
            html += '>';
            html += '<label for="' + caracteristica.id_caracteristica + '"></label>';
            html += '<span>' + caracteristica.nombre_carac + '</span>';
            html += '</div>';
            html += '<div class="caracteristica-linea"></div>';
        }
    });
    html += "<button type='submit'>Guardar cambios</button>";
    document.querySelector("#caracteristicas").innerHTML = html;
}

// Imprime las preguntas y aquí abajo hacemos el update. 
// Los campos input están en required para olvidarnos de hacer delete 
function fShowPreguntas(elemento) {
    document.querySelector("#file-form").style.display = "none";
    document.querySelector("#preguntas").style.display = "block";
    document.querySelector("#imagenes").style.display = "none";
    document.querySelector(".cerrarFto").style.display="none";
    document.querySelector("#botonera-habitacion").style.display="none";
   
    document.querySelector("#caracteristicas").innerHTML = "";

    if (elemento.innerHTML.trim() !== 'preguntas frecuentes') {
        // Si la categoría seleccionada no es la categoría 5, no se imprime nada
        document.querySelector("#preguntas").innerHTML = '';
        return;
    }

    let preguntasData = elemento.parentNode.getAttribute('data-preguntas');
    let preguntas = JSON.parse(preguntasData);

    let respuestasData = elemento.parentNode.getAttribute('data-respuestas');
    let respuestas = JSON.parse(respuestasData);
    
    let html = "";
    preguntas.forEach(pregunta => {
        let respuestaAsociada = respuestas.find(respuesta => respuesta.id_pregunta === pregunta.id_pregunta);
        let valorInput = respuestaAsociada ? respuestaAsociada.respuesta : '';
        html += "<div class='pregunta-input'>";
        html += "<p>" + pregunta.pregunta + "</p>";
        html += "<input required type='text' name='" + pregunta.id_pregunta + "' value='" + valorInput + "'>";
        html += "</div>";
    });
    html += "<button type='submit'>Guardar cambios</button>";
    document.querySelector("#preguntas").innerHTML = html;
}

function actualizarRespuesta(input) {
    let idPregunta = input.getAttribute('name');
    let nuevaRespuesta = input.value;
    let urlVerificar = 'ruta/para/verificar/respuesta'; 
    let urlEliminar = 'ruta/para/eliminar/respuesta'; 

    // Verifica si la respuesta asociada a este input ya existe
    fetch(urlVerificar, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Esto es para Laravel
        },
        body: JSON.stringify({
            id_pregunta: idPregunta
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al verificar la respuesta');
        }
        return response.json();
    })
    .then(data => {
        if (data.existe) {
            // Si la respuesta ya existe y el nuevo valor es vacío, elimina la respuesta
            if (nuevaRespuesta === '') {
                fetch(urlEliminar, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Esto es para Laravel
                    },
                    body: JSON.stringify({
                        id_pregunta: idPregunta
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al eliminar la respuesta');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Respuesta eliminada exitosamente:', data);
                })
                .catch(error => {
                    console.error('Error al eliminar la respuesta:', error);
                });
            } else {
                // Si la respuesta ya existe y el nuevo valor no es vacío, actualiza la respuesta
                fetch('ruta/para/actualizar/respuesta', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Esto es para Laravel
                    },
                    body: JSON.stringify({
                        id_pregunta: idPregunta,
                        respuesta: nuevaRespuesta
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al actualizar la respuesta');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Respuesta actualizada exitosamente:', data);
                })
                .catch(error => {
                    console.error('Error al actualizar la respuesta:', error);
                });
            }
        } else {
            // Si la respuesta no existe y el nuevo valor no es vacío, inserta la respuesta
            if (nuevaRespuesta !== '') {
                fetch('ruta/para/insertar/respuesta', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Esto es para Laravel
                    },
                    body: JSON.stringify({
                        id_pregunta: idPregunta,
                        respuesta: nuevaRespuesta
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al insertar la respuesta');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Respuesta insertada exitosamente:', data);
                })
                .catch(error => {
                    console.error('Error al insertar la respuesta:', error);
                });
            }
        }
    })
    .catch(error => {
        console.error('Error al verificar la respuesta:', error);
    });
}

// Mostrar el formulario de la subida de fotos y vídeos cuando le des click a "fotos"
function fShowFileForm(elemento) {

    document.querySelector("#imagenes").style.display = "block";
    
    let imagenesData = elemento.parentNode.getAttribute('data-imagenes');
    let imagenes = JSON.parse(imagenesData);


    // Vaciar el contenedor de características y preguntas
    document.querySelector("#caracteristicas").innerHTML = "";
    document.querySelector("#preguntas").innerHTML = "";
    document.getElementById("botonera-habitacion").innerHTML= "";

    // Mostrar el formulario de archivos
    document.getElementById("file-form").style.display = "block";
    document.getElementById("file-main-form").style.display = "block";

    // Mostrar la previsualización de las imágenes seleccionadas
    const fileMainInput = document.querySelector("#input-main");
    const fileInput = document.querySelector("#input-secondary");

    
    const imageMainPreview = document.getElementById("image-main-preview");
    imageMainPreview.innerHTML = ""; // Limpiar la previsualización anterior

    const imagePreview = document.getElementById("image-preview");
    imagePreview.innerHTML = ""; // Limpiar la previsualización anterior

    fileMainInput.addEventListener("change", function() {
        const files = Array.from(fileMainInput.files);
        files.forEach(file => {
            if (file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = document.createElement("img");
                    img.src = event.target.result;
                    img.style.maxWidth = "200px"; // Establecer un ancho máximo para la previsualización
                    img.style.marginRight = "30px"; // Espaciado entre imágenes

                    // Agregar un botón para eliminar la imagen
                    const deleteBtn = document.createElement("button");
                    deleteBtn.textContent = "Eliminar";
                    deleteBtn.type = "button"; // Cambiar el tipo de botón a "button"
                    deleteBtn.addEventListener("click", function() {
                        
                        // Encontrar el contenedor padre de la imagen y eliminarlo del DOM
                        const container = deleteBtn.parentNode;
                        container.parentNode.removeChild(container);

                        // Eliminar el archivo del input de tipo file
                        const index = files.indexOf(file);
                        if (index > -1) {
                            files.splice(index, 1);
                            // Crear un nuevo objeto FileList con los archivos restantes
                            const newFileList = new DataTransfer();
                            files.forEach(file => newFileList.items.add(file));
                            // Actualizar el contenido del input de tipo file
                            fileInput.files = newFileList.files;
                        }
                    });

                    // Agregar la imagen y el botón de eliminar al contenedor de previsualización
                    const container = document.createElement("div");
                    container.appendChild(img);
                    container.appendChild(deleteBtn);
                    imageMainPreview.appendChild(container);
                };
                reader.readAsDataURL(file);
            }
        });
    });

    fileInput.addEventListener("change", function() {
        const files = Array.from(fileInput.files);
        files.forEach(file => {
            if (file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = document.createElement("img");
                    img.src = event.target.result;
                    img.style.maxWidth = "200px"; // Establecer un ancho máximo para la previsualización
                    img.style.marginRight = "30px"; // Espaciado entre imágenes

                    // Agregar un botón para eliminar la imagen
                    const deleteBtn = document.createElement("button");
                    deleteBtn.textContent = "Eliminar";
                    deleteBtn.type = "button"; // Cambiar el tipo de botón a "button"
                    deleteBtn.addEventListener("click", function() {
                        
                        // Encontrar el contenedor padre de la imagen y eliminarlo del DOM
                        const container = deleteBtn.parentNode;
                        container.parentNode.removeChild(container);

                        // Eliminar el archivo del input de tipo file
                        const index = files.indexOf(file);
                        if (index > -1) {
                            files.splice(index, 1);
                            // Crear un nuevo objeto FileList con los archivos restantes
                            const newFileList = new DataTransfer();
                            files.forEach(file => newFileList.items.add(file));
                            // Actualizar el contenido del input de tipo file
                            fileInput.files = newFileList.files;
                        }
                    });

                    // Agregar la imagen y el botón de eliminar al contenedor de previsualización
                    const container = document.createElement("div");
                    container.appendChild(img);
                    container.appendChild(deleteBtn);
                    imagePreview.appendChild(container);
                };
                reader.readAsDataURL(file);
            }
        });
    });
}

let array_habitaciones;
// Mostrar la botonera de crear habitación
function fShowHabitacionForm(elemento, id_resi){
    // Vaciar el contenedor de características y preguntas
    document.querySelector("#caracteristicas").style.display = "none";
    document.querySelector("#preguntas").style.display = "none";
    document.querySelector("#imagenes").style.display = "none";
    document.querySelector("#file-form").style.display = "none";
    document.querySelector(".cerrarFto").style.display="none";
    document.querySelector("#botonera-habitacion").style.display="block";
    let habitacionesData = elemento.parentNode.getAttribute('data-habitaciones');
    let habitaciones = JSON.parse(habitacionesData);

    array_habitaciones = habitaciones;

    let html = "";
    html += "<button onclick='fShowHabitaciones()'>Crear habitación</button>";


    habitaciones.forEach(habitacion =>{
        html += "<div class='habitacion'>";
        html += "<p>"+habitacion.nombre+"</p>";
        html += "<button onclick='fEditHabitacion("+habitacion.id_hab+")'>Editar</button>"
        html += "</div>";

    });
    document.querySelector("#botonera-habitacion").innerHTML = html;
}


// Función para imprimir el formulario de las habitaciones
function fShowHabitaciones(){

    // Generamos el formulario para insertar la habitación
    let html = "";
    html +=     "<label for='nombre'>Nombre de la habitación</label>";
    html +=     "<br>";
    html +=     "<input name='nombre' type='text'>";
    html +=     "<br>";
    html +=     "<label for='descripcion'>Descripción de la habitación</label>";
    html +=     "<br>";
    html +=     "<textarea name='descripcion' type='text'></textarea>";
    html +=     "<br>";
    html +=     "<label for='capacidad'>Capacidad de la habitación</label>";
    html +=     "<br>";
    html +=     "<input name='capacidad' type='number'>";
    html +=     "<br>";
    html +=     "<br>";
    html +=     "<label for='precio'>Precio base de la habitación</label>";
    html +=     "<br>";
    html +=     "<input name='precio' type='number'>";
    html +=     "<br>";
    html +=     "<p>Disponibilidad</p>";
    html +=     "<div class='check'>";
    html +=         "<input value='1' name='disponibilidad' type='checkbox'>Disponible";
    html +=         "<input value='0' name='disponibilidad' type='checkbox'>No disponible";
    html +=     "</div>";
    html +=     "<button type='submit'> Añadir </button>";
    document.querySelector("#form-habitaciones").innerHTML = html;

}

function fEditHabitacion(id_hab){
    document.querySelector("#editHab").style.display = "block";

// Ocultar todos los elementos que comienzan con "hab_"
document.querySelectorAll('[id^="hab_"]').forEach(element => {
    element.style.display = "none";
});
document.querySelectorAll('[id^="file_"]').forEach(element => {
    element.style.display = "none";
});
document.querySelectorAll('[id^="imgs_"]').forEach(element => {
    element.style.display = "none";
});
// Mostrar el elemento específico con el id correspondiente
document.querySelector("#hab_" + id_hab).style.display = "block";

document.querySelector("#file_" + id_hab).style.display = "block";
document.querySelector("#imgs_" + id_hab).style.display = "block";

}

function fEditHabitacion(habitacion){
    let html = "";

            html +=     "<label for='nombre'>Nombre de la habitación</label>";
            html +=     "<br>";
            html +=     "<input value='"+habitacion.nombre+"' name='nombre' type='text'>";
            html +=     "<br>";
            html +=     "<label for='descripcion'>Descripción de la habitación</label>";
            html +=     "<br>";
            html +=     "<textarea value='"+habitacion.descripcion+"' name='descripcion' type='text'></textarea>";
            html +=     "<br>";
            html +=     "<label for='capacidad'>Capacidad de la habitación</label>";
            html +=     "<br>";
            html +=     "<input value='"+habitacion.capacidad+"' name='capacidad' type='number'>";
            html +=     "<br>";
            html +=     "<br>";
            html +=     "<label for='precio'>Precio base de la habitación</label>";
            html +=     "<br>";
            html +=     "<input value='"+habitacion.precio+"' name='precio' type='number'>";
            html +=     "<br>";
            html +=     "<p>Disponibilidad</p>";
            html +=     "<div class='check'>";
            if(habitacion.disponibilidad = 1){
                html +=         "<input value='1' name='disponibilidad' type='checkbox' checked >Disponible";
                html +=         "<input value='0' name='disponibilidad' type='checkbox'>No disponible";
            }else{
                html +=         "<input value='1' name='disponibilidad' type='checkbox'>Disponible";
                html +=         "<input value='0' name='disponibilidad' type='checkbox' checked >No disponible";
            }
            html +=     "</div>";
            html +=     "<button type='submit'> Añadir </button>";
    
   

    document.querySelector("#editHab").innerHTML = html;
}

function Finicio(){
    document.querySelector("#contenedorDashboard").style.display="flex";
    document.querySelector("#propiedadDash").style.display="none";
    document.querySelector("#solicitudes").style.display="none";
}
function Fpropiedad(){
    document.querySelector("#contenedorDashboard").style.display="none";
    document.querySelector("#propiedadDash").style.display="flex";
    document.querySelector("#solicitudes").style.display="none";
}
function fCargarSolicitudes(){
    document.querySelector("#contenedorDashboard").style.display="none";
    document.querySelector("#propiedadDash").style.display="none";
    document.querySelector("#solicitudes").style.display="flex";
}