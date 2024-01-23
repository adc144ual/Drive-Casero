<html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" type="text/css" href="styles.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="subir_archivo.js"></script> 
        <script src="ajax.js"></script> 
    </head>

    <body>
    
        <form action="subir_archivo.php" method="post" enctype="multipart/form-data">
            Selecciona un archivo para subir:
            <!-- <input type="file" name="fileToUpload" id="fileToUpload"  webkitdirectory multiple> -->
            <input type="file" name="fileToUpload" id="fileToUpload" >
            <input type="submit" value="Subir archivo" name="submit">
        </form>


        <?php include'abrir_dir.php';
         abrir_directorio('C:/xampp/htdocs/Drive/')
         ?>

    </body>
</html>

