$(document).on('ready', function(e) {
    var time = /^(0[1-9]|1\d|2[0-3]):([0-5]\d)(:[0-5]\d)?$/;

    if ($('#evento-hora_inicio').val() == $('#evento-hora_fin').val()) {
        $('.field-evento-hora_fin').removeClass('has-success');
        $('.field-evento-hora_fin').addClass('has-error');
        $('.field-evento-hora_fin .help-block').text('La hora de fin debe ser posterior a la hora de inicio si las fechas de inicio y fin son iguales.');
    } else {
        $('.field-evento-hora_fin').removeClass('has-error');
        $('.field-evento-hora_fin').addClass('has-success');
        $('.field-evento-hora_fin .help-block').text('');
    }

    $('#evento-fecha_fin-kvdate').on('change blur', function (e) {
        if (new Date($('#evento-fecha_inicio').val() + ' ' + $('#evento-hora_inicio').val()) >= new Date($('#evento-fecha_fin').val() + ' ' + $('#evento-hora_fin').val())) {
            $('.field-evento-fecha_fin').removeClass('has-success');
            $('.field-evento-fecha_fin').addClass('has-error');
            $('.field-evento-fecha_fin .help-block').text('La fecha de fin debe ser posterior o igual a la fecha de inicio.');
            $('.field-evento-hora_fin').removeClass('has-success');
            $('.field-evento-hora_fin').addClass('has-error');
            $('.field-evento-hora_fin .help-block').text('La hora de fin debe ser posterior a la hora de inicio.');
        } else {
            $('.field-evento-fecha_fin').removeClass('has-error');
            $('.field-evento-fecha_fin').addClass('has-success');
            $('.field-evento-fecha_fin .help-block').text('');
            $('.field-evento-hora_fin').removeClass('has-error');
            $('.field-evento-hora_fin').addClass('has-success');
            $('.field-evento-hora_fin .help-block').text('');
        }
    });

    $('#evento-fecha_inicio-kvdate').on('change blur afterValidateAttribute', function (e) {
        if (new Date($('#evento-fecha_inicio').val() + ' ' + $('#evento-hora_inicio').val()) >= new Date($('#evento-fecha_fin').val() + ' ' + $('#evento-hora_fin').val())) {
            $('.field-evento-fecha_fin').removeClass('has-success');
            $('.field-evento-fecha_fin').addClass('has-error');
            $('.field-evento-fecha_fin .help-block').text('La fecha de fin debe ser posterior o igual a la fecha de inicio.');
            $('.field-evento-hora_fin').removeClass('has-success');
            $('.field-evento-hora_fin').addClass('has-error');
            $('.field-evento-hora_fin .help-block').text('La hora de fin debe ser posterior a la hora de inicio.');
        } else {
            $('.field-evento-fecha_inicio').removeClass('has-error');
            $('.field-evento-fecha_inicio').addClass('has-success');
            $('.field-evento-fecha_inicio .help-block').text('');
            $('.field-evento-hora_inicio').removeClass('has-error');
            $('.field-evento-hora_inicio').addClass('has-success');
            $('.field-evento-hora_inicio .help-block').text('');
        }
    });

    $('#evento-hora_fin').on('change blur', function (e) {
        if (new Date($('#evento-fecha_inicio').val() + ' ' + $('#evento-hora_inicio').val()) > new Date($('#evento-fecha_fin').val() + ' ' + $('#evento-hora_fin').val())) {
            $('.field-evento-fecha_fin').removeClass('has-success');
            $('.field-evento-fecha_fin').addClass('has-error');
            $('.field-evento-fecha_fin .help-block').text('La fecha de fin debe ser posterior o igual a la fecha de inicio.');
            $('.field-evento-hora_fin').removeClass('has-success');
            $('.field-evento-hora_fin').addClass('has-error');
            $('.field-evento-hora_fin .help-block').text('La hora de fin debe ser posterior o igual a la hora de inicio.');
        } else {
            $('.field-evento-fecha_fin').removeClass('has-error');
            $('.field-evento-fecha_fin').addClass('has-success');
            $('.field-evento-fecha_fin .help-block').text('');
            $('.field-evento-hora_fin').removeClass('has-error');
            $('.field-evento-hora_fin').addClass('has-success');
            $('.field-evento-hora_fin .help-block').text('');
        }
    });

    $('#evento-hora_inicio').on('change blur afterValidateAttribute', function (e) {
        if (new Date($('#evento-fecha_inicio').val() + ' ' + $('#evento-hora_inicio').val()) > new Date($('#evento-fecha_fin').val() + ' ' + $('#evento-hora_fin').val())) {
            $('.field-evento-fecha_fin').removeClass('has-success');
            $('.field-evento-fecha_fin').addClass('has-error');
            $('.field-evento-fecha_fin .help-block').text('La fecha de fin debe ser posterior o igual a la fecha de inicio.');
            $('.field-evento-hora_fin').removeClass('has-success');
            $('.field-evento-hora_fin').addClass('has-error');
            $('.field-evento-hora_fin .help-block').text('La hora de fin debe ser posterior o igual a la hora de inicio.');
        } else {
            $('.field-evento-fecha_inicio').removeClass('has-error');
            $('.field-evento-fecha_inicio').addClass('has-success');
            $('.field-evento-fecha_inicio .help-block').text('');
            $('.field-evento-hora_inicio').removeClass('has-error');
            $('.field-evento-hora_inicio').addClass('has-success');
            $('.field-evento-hora_inicio .help-block').text('');
        }
    });

    $('#anadirEvento').on('submit', function (e) {
        return !$('.field-evento-fecha_fin').hasClass('has-error') && !$('.field-evento-hora_fin').hasClass('has-error');
    });
});
