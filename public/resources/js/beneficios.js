// Enseñar el contenido de la caja GR
function fShowCajaGR() {
    let html = "";
    html += "<div id='cajaGR'>";
    html += "<p> Hola, soy un contenido de la caja GR</p>";
    html += "</div>";

    document.querySelector("#mouse").insertAdjacentHTML('afterend', html);
}

// // Muestra un formulario tipo input para introducir el correo y solicitar los beneficios
// function fReclamalo(){

//     let html = "";
//     html += "<input type='text' name='correo' placeholder='Correo'>";
//     html += "<button type='submit'>Enviar</button>"

//     document.querySelector("#imagenes-carrusel").insertAdjacentHTML('afterend', html);
// }

// Impresión del formulario para envío de correo Contáctanos
function fShowContactanos(){
    var modal = document.getElementById("modalAyuda");
    modal.style.display = "block";
}