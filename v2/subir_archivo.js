$(document).ready(function () {
    $('form').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData();
        formData.append('fileToUpload', $('#fileToUpload')[0].files[0]);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            processData: false,  // Indica a jQuery que no procese los datos
            contentType: false,  // Indica a jQuery que no establezca el tipo de contenido
            success: function (data) {
                alert("Archivo subido correctamente");
                console.log(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Ha habido un fallo al subir el archivo");
            }
        });
    });
});
