// Código para crear un nuevo evento al pulsar sobre un un día del calendario.

$(document).on('ready', function () {
    $('.fc-day').on('click', function() {
        var fecha = $(this).data('date');
        window.location.href = urlCreate + '&fecha=' + fecha;
    });
});
