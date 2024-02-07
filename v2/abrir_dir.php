<?php 
// function abrir_directorio($dir){
//     // Abre un directorio conocido, y procede a leer su contenido
//     if (is_dir($dir)) {
//         if ($dh = opendir($dir)) {
//             echo "<div id='navegacion'>";
//             while (($file = readdir($dh)) !== false) {
//                 // Concatena la ruta del directorio con el nombre del archivo
//                 $rutaCompleta = $dir . $file;
              
//                //echo $rutaCompleta;
//                 if (is_dir($rutaCompleta)) {
//                     echo "<div id='directorio'>";
//                     echo "<button id='botonNavegar' onclick=navegar('" . ($rutaCompleta) . "')><img src='dir02.png'></button>$file</div>";
                    
//                 } else {
//                     echo "<div id='fichero'><img src='file.jpeg'>";
//                     echo $file . "</div>";
//                 }
                
//             }
//             echo "</div>";
//             closedir($dh);
//         }
//     }
// }


function abrir_directorio($dir){
    // Abre un directorio conocido, y procede a leer su contenido
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            echo "<div id='navegacion'>";
            $count = 0;
            while (($file = readdir($dh)) !== false) {
                // Concatena la ruta del directorio con el nombre del archivo
                $rutaCompleta = $dir . $file;
              
                if($file != '..'){
                    
                    if (is_dir($rutaCompleta)) {
                        if ($count % 5 == 0) {
                            echo "<div class='fila'>";
                        }
                        if($file == '.'){
                            echo "<div id='directorio-vacio'>";
                            $count--;
                        }else{
                        
                            echo "<div id='directorio'>";
                        }
                        
                        echo "<button id='botonNavegar' onclick=navegar('" . ($rutaCompleta) . "')><img class='directorio' src='dir.png'></button>$file</div>";
                        
                        $count++;
                        if ($count % 5 == 0) {
                            echo "</div>";
                        }
                    
                    } else {
                        if ($count % 5 == 0) {
                            echo "<div class='fila'>";
                        }
                        echo "<div id='fichero'><img class='archivo' src='file.png'>";
                        echo $file . "</div>";
                        $count++;
                        if ($count % 5 == 0) {
                            echo "</div>";
                        }
                    }

                }
            
                
            }
            $huecos_restantes = $count % 5;
            if($huecos_restantes > 0){
                $huecos_vacios = 5 - $huecos_restantes;
                for($i=0;$i<$huecos_vacios;$i++){
                    echo "<div id='div-vacio'></div>";
                }
            }
            echo "</div>";
            closedir($dh);
        }
    }
}

?>