function fCargar(){
    document.querySelector("#aprobadas").style.display="none";

}

function fShowCategories(categoriaId) {
    var allCaracteristicas = document.querySelectorAll("[id^='caracteristicas_']");
    allCaracteristicas.forEach(function(caracteristicas) {
        caracteristicas.style.display = 'none';
    });

     // Elimina la clase 'selected' de todos los elementos <p> dentro de #categories
     document.querySelectorAll('#categories p').forEach(function(item) {
        item.classList.remove('selected');
    });

    // Agrega la clase 'selected' al elemento <p> clicado
    var elemento = document.getElementById("category_" + categoriaId);
    elemento.classList.add('selected');

    // Mostrar características de la categoría seleccionada
    var selectedCaracteristicas = document.getElementById("caracteristicas_" + categoriaId);
    if (selectedCaracteristicas) {
        selectedCaracteristicas.style.display = 'block';
    }
}

// Imprimes el bottón "Mis solicitudes"
function FinicioA(){
    document.querySelector(".botoneras").style.display="none";
    document.querySelector("#tarj").style.display="flex";
    document.querySelector("#boton").style.display="flex";
    document.querySelector("#aprobadas").style.display="none";
}

// Ver el detalle de la residencia en "Mis solicitudes"
function fVerDetalle(nombre, ubicacion, url, contenido) {
    let html = "";
    html += "<p>NOMBRE: " + nombre + "</p>";
    html += "<p>UBICACIÓN: " + ubicacion + "</p>";
    html += "<p>URL: " + url + "</p>";
    html += "<p>DESCRIPCIÓN: " + contenido + "</p>";

    document.querySelector("#contenido").innerHTML = html;

    document.querySelector("#verDetalle").style.display = "block";
    document.querySelector("#boton").style.display = "block";
}

// Mostrar únicamente las residencias aprobadas
function fResisAprobadas(){
    document.querySelector(".botoneras").style.display="none";
    document.querySelector("#tarj").style.display="none";
    document.querySelector("#boton").style.display="flex";
    document.querySelector("#aprobadas").style.display="flex";
}

// Mostrar los usuarios registrados 
function fMostrarUsuarios(){
    document.querySelector(".botoneras").style.display="none";
    document.querySelector("#tarj").style.display="none";
    document.querySelector("#boton").style.display="flex";
    document.querySelector("#aprobadas").style.display="none";
    document.querySelector("#usuariosLogeados").style.display="flex";

}
function fMostrarUsuariosGr(){
    document.querySelector(".botoneras").style.display="none";
    document.querySelector("#tarj").style.display="none";
    document.querySelector("#boton").style.display="flex";
    document.querySelector("#aprobadas").style.display="none";
    document.querySelector("#usuariosGr").style.display="flex";
}

function fShow(){
    document.querySelector("#section_header").style.display="block";
    document.querySelector("#resButton").style.display="none";
}

function fAppearCat(){
    document.querySelector("#categories").style.display="flex";
}