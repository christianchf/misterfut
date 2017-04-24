$('#calendarioNac').on('click', function(){
    $('#jugador-fecha_nac').trigger('focus');
});

$('#borrarFecha').on('click', function(){
    $('#jugador-fecha_nac').val('');
});
