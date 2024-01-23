<?php 
function abrir_directorio($dir){
    // Abre un directorio conocido, y procede a leer su contenido
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            echo "<div id='navegacion'>";
            while (($file = readdir($dh)) !== false) {
                // Concatena la ruta del directorio con el nombre del archivo
                $rutaCompleta = $dir . $file;
              
               //echo $rutaCompleta;
                if (is_dir($rutaCompleta)) {
                    echo "<div id='directorio'>";
                    echo "<button id='botonNavegar' onclick=navegar('" . ($rutaCompleta) . "')>$file</button></div>";
                    
                } else {
                    echo "<div id='fichero'>";
                    echo $file . "</div>";
                }
                
            }
            echo "</div>";
            closedir($dh);
        }
    }
}
?>