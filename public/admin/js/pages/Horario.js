$(document).ready(function() {
    $('.active').removeClass('active');
    $('#horarios').addClass('active');
    $('#horarios').parents('.droplink').addClass('active');
    $('#horarios').parents('.droplink').addClass('open');
    $('#horarios').parents('.sub-menu').css('display', 'block');
    $('#file').hide();
});

$('#file-text').click(function(e) {
    e.preventDefault();
    $('#file').click();
});

$('#file').on('change', function() {
    let file_text = document.getElementById("file-text");
    file_text.removeAttribute('readonly', false);
    let file = $(this).val();
    let new_text = file.substr(12);
    $('#file-text').val(new_text);
    file_text.setAttribute('readonly', true);
});

$('#horario-store').click(function(e) {
    e.preventDefault();
    let form = $('#form-horario-store');
    let formURL = form.attr('action');
    let formData = new FormData($('#form-horario-store')[0]);

    $.ajax({
        type: 'post',
        url: formURL+'?'+form.serialize(),
        contentType: false,
        processData: false,
        data: formData,
    })
    .done(function(data) {
        setTimeout(function () {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-full-width",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "100",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
            toastr.success(data, 'Éxito');
        }, 1000);
    })
    .fail(function(res) {
        setTimeout(function () {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-full-width",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
            toastr.error('No ha guardado el horario', '¡Ups!');
        }, 1000);
    })
});

$('#tbl_horarios').on('click', '.btn-horario-download', function(e) {
    e.preventDefault();

    let id = $(this).attr('id');
    $(location).attr('href', horarioDOC.replace('id', id));
});

// Funciones
function ClearHorario() {
    $('#doc').val(null);
    $('#name').val(null);
    $('#file-text').val(null);
    $('#group').val(null).trigger('change');
    $('#modal-horario').modal('hide');
}
