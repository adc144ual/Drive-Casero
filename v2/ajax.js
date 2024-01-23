function navegar(ruta) {
    var xhr = new XMLHttpRequest();
    var url = 'listar.php';
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        console.log(ruta);
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            console.log("Respuesta del servidor:", data);

            let contenedor = document.getElementById("navegacion");
            contenedor.innerHTML = "";


            // Procesa cada archivo en la respuesta
            data.forEach(function (file) {


                // Crea un nuevo elemento button o p

                if (file.type != "dir") {
                    var fichero = document.createElement('div');
                    fichero.id = 'fichero';
                    fichero.textContent = file.name;
                    // Añade el fichero al div
                    contenedor.appendChild(fichero);
                } else {
                    var button = document.createElement('button');
                    button.id = 'botonNavegar';
                    // button.addEventListener('click', function () {
                    //     navegar(file.location);
                    // }, false);
                    button.onclick = function () { navegar(file.location); };
                    button.textContent = file.name;
                    // Añade el botón al div
                    contenedor.appendChild(button);
                }





                // Añade el tipo de archivo al div
                //contenedor.innerHTML += " <b>tipo archivo: </b>" + file.type + "<br>";

                // Añade el div al contenedor
                // contenedor.appendChild(elemento);
                console.log("Todo está guay");
            });

            console.log("Todo está bien");
        } else {
            console.error('Error Jefe:', xhr.status);
        }
    };

    xhr.send('ruta=' + ruta);
}
