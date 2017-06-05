// Ajax para realizar el traspaso másivo de todos los jugadores de un equipo del
// usuario a otro del mismo usuario

var padre = window.opener;
$('#traspaso').on('click', function(){
    var origen = $('#jugadorsearch-nombre').val();
    var destino = idEquipoTraspasar;
    var equipos = JSON.stringify({'origen': origen, 'destino': destino});

    $.ajax({
        url: urlTraspasar,
        contentType: 'application/json',
        method: 'POST',
        data: equipos,
        success: function(data, textStatus, Xhr) {
            $('#plantilla').load(urlDestinoTraspasar + ' #w1-container');
        }
    });
    setTimeout(function(){
        padre.location.href=urlDestinoTraspasar;
        close();
    }, 1500);
});
