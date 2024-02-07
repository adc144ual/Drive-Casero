<?php
// function listar_directorio($dir){
//     $ficheros = array();
//     if (is_dir($dir)) {
//         if ($dh = opendir($dir)) {
//             while (($file = readdir($dh)) !== false) {
//                 $ficheros[] = array(
//                     'name' => $file,
//                     'type' => filetype($dir . $file),
//                     'location' => $dir . $file
//                 );
//             }
//             closedir($dh);
//         }
//     }
//     header('Content-Type: application/json');
//     echo json_encode($ficheros);
// }

// $ruta = $_POST['ruta'];
// listar_directorio($ruta);
?>


<?php
function listar_directorio($dir){
    $ficheros = array();
    
    // Validar la ruta
    $dir = realpath($dir);

    if ($dir && is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                $ficheros[] = array(
                    'name' => $file,
                    'type' => filetype(join(DIRECTORY_SEPARATOR, [$dir, $file])),
                    'location' => join(DIRECTORY_SEPARATOR, [$dir, $file])
                );
            }
            closedir($dh);
        }
    } else {
        // Error ruta no válida 
        $ficheros['error'] = 'Ruta no válida';
    }

    header('Content-Type: application/json');
    echo json_encode($ficheros);
}

// Verificar si se recibió solicitud POST con la ruta
if (isset($_POST['ruta'])) {
    $ruta = $_POST['ruta'];
    listar_directorio($ruta);
} else {
    // Error
    echo json_encode(['error' => 'No se proporcionó la ruta']);
}
?>

