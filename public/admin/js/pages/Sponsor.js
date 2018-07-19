$(document).ready(function() {
    $('.active').removeClass('active');
    $('#sponsor').addClass('active');
    $('#sponsor').parents('.droplink').addClass('open');
    $('#sponsor').parents('.droplink').addClass('active');
    $('#sponsor').parents('.sub-menu').css('display', 'block');
    $('#btn-update').hide();
});

// Eventos
$('#file-input').click(function (e) {
    $('#sponsor_file').click();
});

$('#sponsor_file').on('change', function() {
    previewImage();
});

// CRUD Ajax
$('#btn-store').click(function(e) {
    e.preventDefault();
    let form = $('#form-sponsor-store');
    let formURL = form.attr('action');
    let formData = new FormData($('#form-sponsor-store')[0]);
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
        }, 100);
        cleanSponsor();
        $('#tbl_sponsor').DataTable().ajax.reload();
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
            toastr.error('No se ha añadido el patrocinador', '¡Ups!');
        }, 100);
    });

});

$('#tbl_sponsor').on('click', '.btn-sponsor-edit', function() {
    let id_sponsor = $(this).attr('id');

    $.ajax({
        type: 'get',
        url: sponsorShowURL.replace('id_sponsor', id_sponsor),
        dataType: 'json'
    })
    .done(function (data) {
        $('.icon-image').hide();
        $('#id_sponsor').val(id_sponsor);
        $('#sponsor_image').attr('src', data.image);
        $('#sponsor_name').val(data.sponsor_name);
        $('#btn-store').hide();
        $('#btn-update').show();
    });

});

$('#btn-update').click(function (e) {
    e.preventDefault();
    let imageInput = $('#sponsor_file');
    let sponsorN = $('#sponsor_name').val();
    let id_sponsor = $('#id_sponsor').val();
    let form = $('#form-sponsor-update');
    let formURL = form.attr('action').replace('id_sponsor', id_sponsor);
    let formData = new FormData($('#form-sponsor-store')[0]);
    $.ajax({
        type: 'post',
        url: formURL+'?'+form.serialize(),
        data: formData,
        contentType: false,
        processData: false,
    })
    .done(function (data) {
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
        }, 100);
        cleanSponsor();
        $('#tbl_sponsor').DataTable().ajax.reload();
    })
    .fail(function (res) {
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
            toastr.error('No se ha actualizado el patrocinador', '¡Ups!');
        }, 100);
    });

});

$('#tbl_sponsor').on('click', '.btn-sponsor-delete', function() {
    let tr = $(this).parents('tr');
    let id_sponsor = $(this).attr('id');
    let form = $('#form-sponsor-delete');
    let formURL = form.attr('action').replace('id', id_sponsor);

    $.ajax({
        type: 'delete',
        url: formURL+'?'+form.serialize()
    })
    .done(function(data) {
        setTimeout(function () {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
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
        }, 100);
        tr.fadeOut();
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
            toastr.error('No se ha podido eliminar el patrocinador', '¡Ups!');
        }, 100);
    });

});

$('#btn-cancel').click(function (e) {
    cleanSponsor();
});

// Funciones y Procesos
function previewImage() {
    let preview = document.querySelector('img[id=sponsor_image]');
    let reader = new FileReader();
    let file = document.querySelector('input[id=sponsor_file]').files[0];
    let fileSize = 0;
    let KByte = 0;
    if (file) {
        fileSize = document.querySelector('input[type=file]').files[0].size;
        Kbyte = parseInt(fileSize/1024)
    }

    if (KByte > 3072) {
        alert('La imagen es demasiado grande');
        reader.abort();
    } else {
        reader.onload = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
            $('.icon-image').hide();
        }
        else {
            preview.src="";
            $('.icon-image').show();
        }
    }
}

function cleanSponsor() {
    $('#sponsor_name').val('');
    $('#sponsor_image').attr('src', '');
    $('.icon-image').show();
    $('#sponsor_file').val();
    $('#btn-store').show();
    $('#btn-update').hide();
}
