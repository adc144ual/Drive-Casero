<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreArchivo = $_FILES["fileToUpload"]["name"];
    $tipoArchivo = $_FILES["fileToUpload"]["type"];
    $tamanoArchivo = $_FILES["fileToUpload"]["size"];
    $archivoTemporal = $_FILES["fileToUpload"]["tmp_name"];
    $errorArchivo = $_FILES["fileToUpload"]["error"];

    if ($errorArchivo === UPLOAD_ERR_OK) {
        $directorioDestino = "C:/xampp/htdocs/Drive/uploads/";
        $archivoDestino = $directorioDestino . basename($nombreArchivo);
        if (move_uploaded_file($archivoTemporal, $archivoDestino)) {
            header('Location: index.php?r=0');
            exit;
            
            #echo "El archivo se ha subido correctamente.";
        } else {
            #echo "Hubo un error al subir el archivo.";
            header('Location: index.php?r=1');
            exit;
        }
    } else {
        echo "Hubo un error al subir el archivo. Código de error: " . $errorArchivo;
    }
}
?>
