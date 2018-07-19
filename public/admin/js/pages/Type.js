$(document).ready(function() {
    $('#type-store').click(function (e) {
        e.preventDefault();
        let form = $('#form-type');
        let formURL = form.attr('action');
        let typeForm = $('#form-type-name')
        let msg;

        $.ajax({
            type: 'post',
            url: formURL+'?'+form.serialize(),
            data: {
                'type_name': $('#type_name').val()
            }
        })
        .done(function (data) {
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
            typeForm.find('.error-msg').text('');
            typeForm.removeClass('has-error');
            $('#tbl_type').DataTable().ajax.reload();
            $('#type_name').val("");
            $('#modal-type').modal('hide');
        })
        .fail(function (res) {
            let error = res.responseJSON;
            for (var i in error['errors']) {
                let dta = error['errors'];
                msg = dta[i];
            }
            typeForm.find('.error-msg').text(msg);
            typeForm.addClass('has-error');
        });
    });

    $('#tbl_type tbody').on('click', '.btn-type-edit', function () {
        let id_type = $(this).attr('id');
        let typeEditURL = typeEdit.replace('id_type', id_type);

        $.ajax({
            type: 'get',
            url: typeEditURL,
            dataType: 'json'
        })
        .done(function (data) {
            $('#title-type').text("Editar Tipo de publicación");
            $('#type-id').val(data.id);
            $('#type_name').val(data.type_name);
            $('#type-edit').show();
            $('#type-store').hide();
            $('#modal-type').modal('show');
        })
        .fail(function (res) {
            let error = res.responseJSON;
            console.log(error);
        });

    });

    $('#type-edit').click(function(e) {
        e.preventDefault();

        let id_type = $('#type-id').val();
        let form = $('#form-type-update');
        let formURL = form.attr('action').replace('id', id_type);
        console.log(formURL);
        let msg;
        let typeForm = $('#form-type-name');

        $.ajax({
            type: 'put',
            url: formURL+'?'+form.serialize(),
            data: {
                'type_name':    $('#type_name').val()
            }
        })
        .done(function (data) {
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
                    "hideMethod": "fadeOut",
                    "tapToDismiss": false
                };
                toastr.success(data, 'Éxito');
            }, 100);
            ClearType();
            typeForm.find('.error-msg').text('');
            typeForm.removeClass('has-error');
            $('#tbl_type').DataTable().ajax.reload();
            $('#modal-type').modal('hide');

        })
        .fail(function (res) {
            let error = res.responseJSON;

            for (let i in error['errors']) {
                let dta = error['errors'];
                msg = dta[i];
            }
            typeForm.find('.error-msg').text(msg);
            typeForm.addClass('has-error');
        });
    });

    $('#tbl_type tbody').on('click', '.btn-type-delete', function() {
        let tr = $(this).parents('tr');
        let id_type = $(this).attr('id');
        let form = $('#form-type-delete');
        let formURL = form.attr('action').replace('id', id_type);

        $.ajax({
            type: 'delete',
            url: formURL+'?'+form.serialize(),
        })
        .done(function (data) {
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
        .fail(function (res) {
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
        });
    });

});

function ClearType(){
    $('#type-id').val('');
    $('#type_name').val('');
    $('#type-edit').hide();
    $('#type-store').show();
    $('#title-type').text('Crear Tipo de publicación');
}
