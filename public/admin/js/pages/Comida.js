$(document).ready(function() {
    $('.active').removeClass('active');
    $('#comida').addClass('active');
    $('#comida').parents('.droplink').addClass('active');
    $('#comida').parents('.droplink').addClass('open');
    $('#comida').parents('.sub-menu').css('display', 'block');
    date();

    $('#comida-store').click(function(e) {
        let form = $('#form-comida-store');
        let formURL = form.attr('action');

        $.ajax({
            type: 'post',
            url: formURL+'?'+form.serialize(),
            data: {
                'title':    $('#title').val(),
                'fecha_ini':    $('#fecha_ini').val(),
                'fecha_fin':    $('#fecha_fin').val(),
                'monday':   $('#monday').val(),
                'thuesday': $('#thuesday').val(),
                'wednesday':    $('#wednesday').val(),
                'thursday': $('#thursday').val(),
                'friday':   $('#friday').val()
            }
        })
        .done(function(data) {
            setTimeout(function () {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "3000",
                    "extendedTimeOut": "100",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "tapToDismiss": false
                };
                toastr.success(data, 'Éxito');
            }, 100);
            $('#tbl_comida').DataTable().ajax.reload();
            cleanComida();
        })
        .fail(function(res) {
            let error = res.responseJSON;
            let msg, dta, fail;
            for (let i in error['errors']) {
                dta = error['errors'];
                fail = dta[i];
                msg = fail[0];
                showComidaErrors(i, msg);
            }
            setTimeout(function () {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-center",
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
                toastr.error('No se ha podido guardar el menú de comida', '¡Ups!');
            }, 100);
        });

    });

    $('#tbl_comida tbody').on('click', '.btn-comida-edit', function(e){
        e.preventDefault();
        let id_comida = $(this).attr('id');
        let formURL = comidaURLShow.replace('id_comida', id_comida);
        console.log(formURL);

        $.ajax({
            type: 'get',
            url: comidaURLShow.replace('id_comida', id_comida),
            dataType: 'json'
        })
        .done(function(data) {
            $('#comida-edit').show();
            $('#comida-store').hide();
            $('#comida-id').val(data.id);
            $('#title').val(data.title);
            $('#fecha_ini').val(data.fecha_ini);
            $('#fecha_fin').val(data.fecha_fin);
            $('#monday').val(data.monday);
            $('#thuesday').val(data.thuesday);
            $('#wednesday').val(data.wednesday);
            $('#thursday').val(data.thursday);
            $('#friday').val(data.friday);
            $('#modal-comida').modal('show');
        });

    })

    $('#comida-edit').click(function(e) {
        let id_comida = $('#comida-id').val();
        let form = $('#form-comida-update');
        let formURL = form.attr('action').replace('id_comida', id_comida);

        $.ajax({
            type: 'put',
            url: formURL+'?'+form.serialize(),
            data: {
                'title':    $('#title').val(),
                'fecha_ini':    $('#fecha_ini').val(),
                'fecha_fin':    $('#fecha_fin').val(),
                'monday':   $('#monday').val(),
                'thuesday': $('#thuesday').val(),
                'wednesday':    $('#wednesday').val(),
                'thursday': $('#thursday').val(),
                'friday': $('#friday').val()
            }
        })
        .done(function(data) {
            setTimeout(function () {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "3000",
                    "extendedTimeOut": "100",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "tapToDismiss": false
                };
                toastr.success(data, 'Éxito');
            }, 100);
            $('#tbl_comida').DataTable().ajax.reload();
            cleanComida();
        })
        .fail(function(res) {
            let error = res.responseJSON;
            let msg, dta, fail;
            for (let i in error['errors']) {
                dta = error['errors'];
                fail = dta[i];
                msg = fail[0];
                showComidaErrors(i, msg);
            }
            setTimeout(function () {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-center",
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
                toastr.error('No se ha podido guardar el curso', '¡Ups!');
            }, 100);
        });

    });

    $('#tbl_comida tbody').on('click', '.btn-comida-delete', function(e) {
        let tr = $(this).parents('tr');
        let id_comida = $(this).attr('id');
        let form = $('#form-comida-delete');
        let formURL = form.attr('action').replace('id_comida', id_comida);

        $.ajax({
            type: 'delete',
            url: formURL+'?'+form.serialize(),
        })
        .done(function(data) {
            setTimeout(function () {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "3000",
                    "extendedTimeOut": "100",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "tapToDismiss": false
                };
                toastr.success(data, 'Éxito');
            }, 100);
            tr.fadeOut();
            $('#tbl_comida').DataTable().ajax.reload();
        })
        .fail(function(res) {
            let error = res.responseJSON;
            setTimeout(function () {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-center",
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
                toastr.error(error, '¡Ups!');
            }, 100);
            $('#tbl_grupo').DataTable().ajax.reload();
        });

    });

    $('#tbl_comida tbody').on('click', '.btn-comida-pdf', function(e) {
        e.preventDefault();

        let id_comida = $(this).attr('id');
        $(location).attr('href', comidaPDF.replace('id_comida', id_comida));
    });

});

function date() {
    $('.date-picker').datepicker({
        orientation: "top auto",
        autoclose: true,
        daysOfWeekDisabled: "0,6",
        format: "yyyy-mm-dd"
    });
}

function showComidaErrors(name, error) {
    let form = $('#form-comida-'+name);
    form.addClass('has-error');
    form.find('.error-msg').text(error);
}

function cleanComida() {
    $('#comida-id').val('');
    $('#comida-edit').hide();
    $('#comida-store').show();
    let title = $('#title-comida').text();
    let new_title = title.replace('Editar', 'Crear nuevo');
    $('#title-comida').text(new_title);
    $('.has-error').removeClass('has-error');
    $('.error-msg').text('');
    $('#title').val('');
    $('#fecha_ini').val('');
    $('#fecha_fin').val('');
    $('#monday').val('');
    $('#thuesday').val('');
    $('#wednesday').val('');
    $('#thursday').val('');
    $('#friday').val('');
    $('#modal-comida').modal('hide');
}
