// Oculta el campo de fecha si el jugador no está lesionado

if ($('#jugador-esta_lesionado').is(':checked')) {
    $('.field-jugador-fecha_alta').show();
} else {
    $('.field-jugador-fecha_alta').hide();
    $('#jugador-fecha_alta').val(null);
}

$('#jugador-esta_lesionado').on('click', function (e) {
    if ($(this).is(':checked')) {
        $('.field-jugador-fecha_alta').show();
    } else {
        $('.field-jugador-fecha_alta').hide();
        $('#jugador-fecha_alta').val(null);
    }
});
