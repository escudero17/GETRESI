// $(window).scroll(function (event) {
//     var scrollLeft = $(window).scrollLeft();
//     var scrollTop = $(window).scrollTop();
//     var mapa = $("#mapa-ciudad");

//     if (scrollTop >= 100) {
//         document.querySelector('nav').style.position = "fixed";
//         document.querySelector('nav').style.zIndex = "100";
//         $("#mapa-ciudad").css({ top: "160px" });
//         }
//     if (scrollTop >= 200) {
//         document.querySelector("footer").style.display = "none";
//         document.querySelector("#mapa-ciudad").style.top = "160px";
//         $("#mapa-ciudad").css({ top: "160px" });
//     }
//     if (scrollTop >= 300) {
//         document.querySelector('#fechas-residencias').style.position = "fixed";
//         document.querySelector('#fechas-residencias').style.zIndex = "100";
//         document.querySelector('#fechas-residencias').style.top = "40px";
//         document.querySelector("#contenedor-residencias").style.marginTop = "70px";
//         document.querySelector("section").style.justifyContent = "left";
//         document.querySelector("section").style.marginLeft = "20px";
//         $("#mapa-ciudad").css({ top: "390px" });
//     }
//     if (scrollTop < 100) {
//         document.querySelector('nav').style.position = "";
//         document.querySelector("nav").style.backgroundColor = "white";
//         document.querySelector("#mapa-ciudad").style.top = "390px";
//     }
//     if (scrollTop < 200) {
//         document.querySelector("#contenedor-section").style.width = "55%";
//         document.querySelector("#contenedor-section").style.paddingRight = "0";
//         document.querySelector("#mapa-ciudad").style.top = "390px";

//     }
//     if (scrollTop < 300) {
//         document.querySelector("#contenedor-buscador").style.display = "flex";
//         document.querySelector('#fechas-residencias').style.position = "";
//         document.querySelector('#fechas-residencias').style.width = "100%";
//         document.querySelector("#contenedor-residencias").style.marginTop = "0px";
//         document.querySelector("#mapa-ciudad").style.top = "390px";
//     }
// });


$(window).scroll(function () {
    var scrollTop = $(window).scrollTop();
    var mapa = $("#mapa-ciudad");

    if (scrollTop >= 300) {
        $("nav").css({ position: "fixed", zIndex: "100" });
        mapa.css({ top: "390px" });
        $("footer").hide();
    } else if (scrollTop >= 200) {
        mapa.css({ top: "160px" });
    } else if (scrollTop >= 100) {
        $("nav").css({ position: "fixed", zIndex: "100" });
        mapa.css({ top: "160px" });
    } else {
        $("nav").css({ position: "", backgroundColor: "white" });
        mapa.css({ top: "160px" });
    }
    if (scrollTop < 200) {
        $("#contenedor-section").css({ width: "55%", paddingRight: "0" });
    }
    if (scrollTop < 300) {
        $("#contenedor-buscador").css({ display: "flex" });
        $("#fechas-residencias").css({ position: "", width: "100%" });
        $("#contenedor-residencias").css({ marginTop: "0px" });
    }
});

$(document.querySelector("#contenedor-residencias")).scroll(function (event) {
    var scrollLeft = $(window).scrollLeft();
    var scrollTop = $(window).scrollTop();

    if (scrollTop >= 100) {
        document.querySelector('nav').style.position = "fixed";
        document.querySelector('nav').style.zIndex = "100";

    }
   
});


// Impresión del formulario para envío de correo Contáctanos
function fShowContactanos(){
    document.querySelector(".cosas").innerHTML = "";

    let html = "";
    html += "<input type='text' name='correo' placeholder='Correo'>";
    html += "<input type='text' name='contenido' placeholder='Escribe aquí tu comentario'>";
    html += "<button type='submit'>Enviar</button>"

    document.querySelector("#formCorreo").innerHTML = html;

}

// Impresión del formulario para envío de correo Contáctanos
function fShowContactanos(){
    document.querySelector(".cosas").innerHTML = "";

    let html = "";
    html += "<input type='text' name='correo' placeholder='Correo'>";
    html += "<input type='text' name='contenido' placeholder='Escribe aquí tu comentario'>";
    html += "<button type='submit'>Enviar</button>"

    document.querySelector("#formCorreo").innerHTML = html;
}
