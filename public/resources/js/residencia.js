function fOnLoad() {
    document.querySelector("#contenido-habitaciones").style.display = "none";
    document.querySelector("#contenido-opiniones").style.display = "none";
    document.querySelector("#contenido-preguntas").style.display = "none";
    document.querySelector("#info-residencia-adicional").style.display = "flex";
}

function fOpenInfo() {
    document.querySelector("#ctHab").style.display = "none";
    document.querySelector("#contenido-habitaciones").style.display = "none";
    document.querySelector("#contenido-opiniones").style.display = "none";
    document.querySelector("#contenido-preguntas").style.display = "none";
    document.querySelector("#info-residencia-adicional").style.display = "flex";
}

function fOpenPrecios() {
    document.querySelector("#ctHab").style.display = "flex";
    document.querySelector("#contenido-habitaciones").style.display = "flex";
    document.querySelector("#contenido-opiniones").style.display = "none";
    document.querySelector("#contenido-preguntas").style.display = "none";
    document.querySelector("#info-residencia-adicional").style.display = "none";
}

function fOpenOpiniones() {
    
    document.querySelector("#ctHab").style.display = "none";
    document.querySelector("#contenido-habitaciones").style.display = "none";
    document.querySelector("#contenido-opiniones").style.display = "flex";
    document.querySelector("#contenido-preguntas").style.display = "none";
    document.querySelector("#info-residencia-adicional").style.display = "none";
}

function fOpenPreguntasFrecuentes() {
    
    document.querySelector("#ctHab").style.display = "none";
    document.querySelector("#contenido-habitaciones").style.display = "none";
    document.querySelector("#contenido-opiniones").style.display = "none";
    document.querySelector("#contenido-preguntas").style.display = "flex";
    document.querySelector("#info-residencia-adicional").style.display = "none";
}

function fCargarCarrusel(){
    document.querySelector("#carruselPhotos").style.display="flex";
}

function fCerrarModal(){
    document.querySelector("#carruselPhotos").style.display="none";
}

