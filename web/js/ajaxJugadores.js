var btns = $('.btnActualizar');

$(document).on('ready', function () {
    generarBtnsPortero();
    $.ajax({
        url: urlJugador,
        method: 'POST',
        success: function(data, textStatus, Xhr) {
            var datos = JSON.parse(data);
            mostrarDatos(datos);
        }
    });
});

btns.on('click', ajaxBotones);

function mostrarDatos(datos) {
    $('#jugados').text(datos['jugados']);
    $('#golesMarcados').text(datos['golesMarcados']);
    $('#golesEncajados').text(datos['golesEncajados']);
    $('#asistencias').text(datos['asistencias']);
    $('#golesPartido').text(datos['golesPartido']);
}

function ajaxBotones() {
    var idBtn = $(this).attr('id');
    $.ajax({
        url: urlJugador,
        method: 'POST',
        data: JSON.stringify({'idBtn': idBtn}),
        success: function(data, textStatus, Xhr) {
            var datos = JSON.parse(data);
            mostrarDatos(datos);
        }
    });
}

function generarBtnsPortero() {
    var cabGolesEncaj = '<th>Goles encajados</th>';
    var sumGolesEncaj = '<td><button id="suma3" class="btn btn-xs btn-info btnMas btnActualizar">' +
        '<span class="glyphicon glyphicon-plus"></span></button></td>';
    var golesEncaj = '<td id="golesEncajados"></td>';
    var restGolesEncaj = '<td><button id="resta3" class="btn btn-xs btn-warning btnMenos btnActualizar">' +
    '<span class="glyphicon glyphicon-minus"></span></button></td>';

    if (posJugador == 1) {
        $("#cabecera").append(cabGolesEncaj);
        $("#btnsSuma").append(sumGolesEncaj);
        $("#datosJugador").append(golesEncaj);
        $("#btnsResta").append(restGolesEncaj);
        $("#suma3").on('click', ajaxBotones);
        $("#resta3").on('click', ajaxBotones);
    }
}
