// Botones del campo del calendario del formulario de creación y modificación de
// jugadores.

$('#calendarioNac').on('click', function(){
    $('#jugador-fecha_nac').trigger('focus');
});

$('#borrarFecha').on('click', function(){
    $('#jugador-fecha_nac').val('');
});
