<?php
    if(isset($_GET['r'])){
        if($_GET['r']==0){
            echo "El archivo se ha subido correctamente.";
        }else{
            echo "Hubo un error al subir el archivo.";
        }
    }
    
?>
<form action="subir_archivo.php" method="post" enctype="multipart/form-data">
    Selecciona un archivo para subir:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Subir archivo" name="submit">
</form>


<?php
$dir = 'C:/xampp/htdocs/Drive Casero/';

// Abre un directorio conocido, y procede a leer su contenido
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if(filetype($dir . $file) == "dir"){
                echo "<button>nombre archivo</button> $file - <b>tipo archivo: </b>" . filetype($dir . $file) . "<br>";
            }
            echo "<b>nombre archivo:</b> $file - <b>tipo archivo: </b>" . filetype($dir . $file) . "<br>";
        }
        closedir($dh);
    }
}
?>
