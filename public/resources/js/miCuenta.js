function saveChanges() {
    // Obtener los nuevos valores de los campos de entrada
    var nombre = document.getElementById('nombre').value;
    var apellidos = document.getElementById('apellidos').value;
    var correo = document.getElementById('correo').value;
    var telefono = document.getElementById('telefono').value;

    // Enviar la solicitud AJAX al servidor
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "{{ route('actualizarUsuario') }}", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    // Datos a enviar en la solicitud
    var data = JSON.stringify({
        nombre: nombre,
        apellidos: apellidos,
        correo: correo,
        telefono: telefono
    });

    // Manejar la respuesta del servidor
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // La solicitud fue exitosa, actualizar los campos de entrada con los nuevos valores
            var responseData = JSON.parse(xhr.responseText);
            document.getElementById('nombre').value = responseData.nombre;
            document.getElementById('apellidos').value = responseData.apellidos;
            document.getElementById('correo').value = responseData.correo;
            document.getElementById('telefono').value = responseData.telefono;
        }
    };

    // Enviar la solicitud con los datos
    xhr.send(data);
}