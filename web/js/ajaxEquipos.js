// Actualiza las estadísticas de los equipos

var btns = $('.btnActualizar');

$(document).on('ready', function () {
    $.ajax({
        url: urlEquipos,
        method: 'POST',
        success: function(data, textStatus, Xhr) {
            var datos = JSON.parse(data);
            mostrarDatos(datos);
        }
    });
});

btns.on('click', function() {
    var idBtn = $(this).attr('id');
    $.ajax({
        url: urlEquipos,
        method: 'POST',
        data: JSON.stringify({'idBtn': idBtn}),
        success: function(data, textStatus, Xhr) {
            var datos = JSON.parse(data);
            mostrarDatos(datos);
        }
    });
});

function mostrarDatos(datos) {
    $('#jugados').text(datos['jugados']);
    $('#ganados').text(datos['ganados']);
    $('#empatados').text(datos['empatados']);
    $('#perdidos').text(datos['perdidos']);
    $('#golesFavor').text(datos['golesFavor']);
    $('#golesContra').text(datos['golesContra']);
}
