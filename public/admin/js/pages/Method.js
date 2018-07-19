$(document).ready(function() {
    $('.active').removeClass('active');
    $('#metodos').addClass('active');
    $('#metodos').parents('.droplink').addClass('active');
    $('#metodos').parents('.droplink').addClass('open');
    $('#metodos').parents('.sub-menu').css('display', 'block');

    $('#metodo-store').click(function(e) {
        e.preventDefault();

        let form = $('#form-metodo');
        let formURL = form.attr('action');

        $.ajax({
            type: 'post',
            url: formURL+'?'+form.serialize(),
            data: {
                'name': $('#method_name').val(),
                'content': $('#content').val()
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
            $('#tbl_metodos').DataTable().ajax.reload();
            ClearMethod();
        })
        .fail(function(res) {
            let error = res.responseJSON;
            let msg, dta, fail;
            for (let i in error['errors']) {
                dta = error['errors'];
                fail = dta[i];
                msg = fail[0];
                showMethodError(i, msg);
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

    $('#tbl_metodos tbody').on('click', '.btn-metodo-edit', function(){
        let id_metodo = $(this).attr('id');
        console.log(metodoShowURL);

        $.ajax({
            type: 'get',
            url: metodoShowURL.replace('id', id_metodo),
            dataType: 'json'
        })
        .done(function(data) {
            $('#title-metodo').text('Editar Curso');
            $('#metodo-id').val(data.id);
            $('#method_name').val(data.method_name);
            $('#content').val(data.content);
            $('#metodo-edit').show();
            $('#metodo-store').hide();
            $('#modal-metodo').modal('show');
        })

    });

    $('#metodo-edit').click(function(e) {
        let id_metodo = $('#metodo-id').val();
        let form = $('#form-metodo-update');
        let formURL = form.attr('action').replace('id', id_metodo);

        $.ajax({
            type: 'put',
            url: formURL+'?'+form.serialize(),
            data: {
                'name': $('#method_name').val(),
                'content':  $('#content').val()
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
            $('#tbl_metodos').DataTable().ajax.reload();
            ClearMethod();
        })
        .fail(function(res) {
            let error = res.responseJSON;
            let msg, dta, fail;
            for (let i in error['errors']) {
                dta = error['errors'];
                fail = dta[i];
                msg = fail[0];
                showMethodError(i, msg);
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

    $('#tbl_metodos tbody').on('click', '.btn-metodo-delete', function() {
        let tr = $(this).parents('tr');
        let id_metodo = $(this).attr('id');
        let form = $('#form-metodo-delete');
        let formURL = form.attr('action').replace('id', id_metodo);

        $.ajax({
            type: 'delete',
            url: formURL+'?'+form.serialize()
        })
        .done(function(data){
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
        })
        .fail(function(res) {
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

function ClearMethod() {
    $('#title-metodo').text('Agregar Método')
    $('#method_name').val('');
    $('#content').val('');
    $('#metodo-edit').hide();
    $('#metodo-store').show();
    $('.has-error').removeClass('has-error');
    $('.error-msg').text('');
    $('#modal-metodo').modal('hide');
}

function showMethodError(name, error) {
    let form = $('#form-metodo-'+name);
    form.addClass('has-error');
    form.find('.error-msg').text(error);
}
