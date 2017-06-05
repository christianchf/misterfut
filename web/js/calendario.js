// Crea el calendario de eventos

$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today myCustomButton',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: eventos,
        editable: true,
        dayClick: function(date, jsEvent, view) {
            var fecha = date.format();
            var diaInicio = fecha.substr(0,10);
            var horaInicio = fecha.substr(11);
            window.location.href = urlCreate + '&dia=' + diaInicio + '&hora=' + horaInicio;
        },
        eventDrop: function(event, delta, revertFunc, jsEvent, ui, view) {
            actualizarEvento(event, delta, revertFunc, jsEvent, ui, view);
        },
        eventResize: function(event, delta, revertFunc, jsEvent, ui, view) {
            actualizarEvento(event, delta, revertFunc, jsEvent, ui, view);
        }
    });
});

function actualizarEvento(event, delta, revertFunc, jsEvent, ui, view) {
    var idEvento = event.id;
    var fechaInicio = event.start.format();
    var diaInicio = fechaInicio.substr(0,10);
    var horaInicio = fechaInicio.substr(11);
    var fechaFin = event.end.format();
    var diaFin = fechaFin.substr(0,10);
    var horaFin = fechaFin.substr(11);
    $.ajax({
        url: urlEventos,
        method: 'POST',
        data: JSON.stringify({
            'idEvento': idEvento,
            'diaInicio': diaInicio,
            'horaInicio': horaInicio,
            'diaFin': diaFin,
            'horaFin': horaFin
        })
    });
}
