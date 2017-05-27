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
        eventDrop: function(event, delta, revertFunc, jsEvent, ui, view) {
            var idEvento = event.id;
            var diaInicio = event.start.format();
            var diaFin = event.end.format();
            $.ajax({
                url: urlEventos,
                method: 'POST',
                data: JSON.stringify({'idEvento': idEvento, 'diaInicio': diaInicio, 'diaFin': diaFin}),
            });
        }
    });
});
