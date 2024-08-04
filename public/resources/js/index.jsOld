function fCargarHomepageCiudades() {

}

function fCargarResidencias() {

}

function fCargarCiudades() {
    fCargarFiltros();
    document.querySelector("#mapa-ciudad").innerHTML = "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d194348.23369181997!2d-3.8443459223902665!3d40.437837282443894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422997800a3c81%3A0xc436dec1618c2269!2sMadrid!5e0!3m2!1sen!2ses!4v1710150755373!5m2!1sen!2ses' width='600' height='450' style='border:0;' allowfullscreen=' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>";
}

// Enseña el menú desplegable de "Mi cuenta"
function fShowMenu() {
    const dropdownMenu = document.getElementById("dropdownMenu");
    // Si está oculto, lo muestra; si está visible, lo oculta
    dropdownMenu.style.display = dropdownMenu.style.display === "none" ? "block" : "none";
}

// Cierra el menú desplegable si se hace clic fuera de él
window.onclick = function (event) {
    if (!event.target.matches('#btnMiCuenta')) {
        const dropdownMenu = document.getElementById("dropdownMenu");
        dropdownMenu.style.display = "none"; // Oculta el menú desplegable
    }
}


// Impresión del formulario para envío de correo Contáctanos
function fShowContactanos(){
    var modal = document.getElementById("modalAyuda");
    modal.style.display = "block";
}