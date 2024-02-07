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
            let contador = 0;

            var fila;
            // Procesa cada archivo en la respuesta
            data.forEach(function (file) {


                if (contador % 5 == 0) {
                    fila = document.createElement('div');
                    fila.classList.add('fila');
                }

                // Crea un nuevo elemento button o p

                if (file.type != "dir") {


                    var fichero = document.createElement('div');
                    fichero.id = 'fichero';
                    let img = document.createElement('img');
                    img.src = 'file.png';
                    img.classList.add('archivo');
                    fichero.textContent = dividirCadena(file.name);


                    // Añade el fichero al div
                    fichero.appendChild(img);
                    fila.appendChild(fichero);
                    contenedor.appendChild(fila);

                } else {

                    if (file.name == '.') {
                        var vacio = document.createElement('div');
                        vacio.id = 'directorio-vacio';
                        fila.appendChild(vacio);
                        contador--;
                    } else {

                        let directorio = document.createElement('div');
                        directorio.id = 'directorio';

                        var button = document.createElement('button');
                        button.id = 'botonNavegar';
                        // button.addEventListener('click', function () {
                        //     navegar(file.location);
                        // }, false);
                        button.onclick = function () { navegar(file.location); };
                        if (file.name != '..') {
                            button.textContent = file.name;
                        }

                        let img = document.createElement('img');
                        if (file.name == '..') {
                            img.src = 'anterior.png';
                        } else {
                            img.src = 'dir.png';
                        }

                        button.appendChild(img);

                        directorio.appendChild(button);
                        fila.appendChild(directorio);
                        contenedor.appendChild(fila);
                    }

                }

                contador++;



                // Añade el tipo de archivo al div
                //contenedor.innerHTML += " <b>tipo archivo: </b>" + file.type + "<br>";

                // Añade el div al contenedor
                // contenedor.appendChild(elemento);
                console.log("Todo está guay");
            });
            if (contador % 5 !== 0) {
                let huecos_restantes = contador % 5;
                if (huecos_restantes > 0) {
                    let huecos_vacios = 5 - huecos_restantes;
                    for (let i = 0; i < huecos_vacios; i++) {
                        let div_vacio = document.createElement('div');
                        div_vacio.id = 'div-vacio';
                        fila.appendChild(div_vacio);

                    }
                }
            }



            console.log("Todo está bien");
        } else {
            console.error('Error Jefe:', xhr.status);
        }
    };

    xhr.send('ruta=' + ruta);
}

window.addEventListener("load", function () {
    // Puedes acceder a variables dentro de esta función
    const ruta = 'C:/xampp/htdocs/Drive/';
    navegar(ruta);
});


function dividirCadena(cadena) {
    let nuevaCadena = ''; // Inicia sin una línea vacía al principio
    let lineas = 0; // Comienza contando desde cero

    if (cadena.includes(' ')) { // Si la cadena contiene espacios
        let palabras = cadena.split(' ');
        let lineaActual = '';

        for (let i = 0; i < palabras.length; i++) {
            if (palabras[i].length > 11) { // Si la palabra tiene más de 11 caracteres
                let subPalabras = palabras[i].match(/.{1,11}/g); // Divide la palabra en subpalabras de 11 caracteres
                for (let j = 0; j < subPalabras.length; j++) {
                    nuevaCadena += subPalabras[j] + (j < subPalabras.length - 1 ? '-\n' : '\n');
                    lineas++;
                }
            } else if ((lineaActual + palabras[i]).length > 11) {
                nuevaCadena += lineaActual.trim() + '\n';
                lineaActual = palabras[i] + ' ';
                lineas++;
            } else {
                lineaActual += palabras[i] + ' ';
            }
        }

        nuevaCadena += lineaActual + '\n'; // Añade la última línea
        lineas++;

    } else { // Si la cadena no contiene espacios
        for (let i = 0; i < cadena.length; i += 11) {
            nuevaCadena += cadena.slice(i, i + 11) + (i + 11 < cadena.length ? '-\n' : '\n');
            lineas++;
        }
    }

    if (lineas === 1) {
        nuevaCadena = '\n' + nuevaCadena + '\n' + '\n'; // Añade una línea vacía al principio y al final si la cadena ocupa 1 línea
    } else if (lineas === 2 && cadena.includes(' ')) {
        nuevaCadena = '\n' + nuevaCadena + '\n'; // Añade una línea vacía al final si la cadena ocupa 2 líneas y contiene espacios
    } else if (lineas === 2 && cadena.length > 11) {
        nuevaCadena = '\n' + nuevaCadena + '\n'; // Añade una línea vacía al final si la cadena ocupa 2 líneas y es una palabra larga
    } else if (lineas == 3) {
        nuevaCadena = '\n' + nuevaCadena; // Quita el salto de línea al principio y al final si la cadena ocupa 3 o 4 líneas
    } else if (lineas == 4) {
        nuevaCadena = nuevaCadena.trim(); // Quita el salto de línea al principio y al final si la cadena ocupa 3 o 4 líneas
    } else if (lineas > 4) {
        let lineasCadena = nuevaCadena.split('\n');
        lineasCadena[3] = lineasCadena[3].substring(0, lineasCadena[3].length - 3) + '...';
        nuevaCadena = lineasCadena.slice(0, 4).join('\n');
    }

    return nuevaCadena;
}
