$(document).ready(function(){
    $('#grp-edit').hide();

    $('#tbl_grupo tbody').on('click', '.btn-grp-delete', function () {
        let tr = $(this).parents('tr');
        let grupo_id = $(this).attr('id');
        let form = $('#form-grp-delete');
        let formURL = form.attr('action').replace('id', grupo_id);

        $.ajax({
            type: 'delete',
            url: formURL+'?'+form.serialize()
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
            $('#tbl_grupo').DataTable().ajax.reload();
        });
    });
});


// Eventos y CRUD's
$('#group_name').on('keyup', function () {
    $('#form-group-name').removeClass('has-error');
    $('#form-group-name').find('.error-msg').text('');
});

$('#grupo').click(function (e) {
    e.preventDefault()
    let form = $('#form-grp');
    let formURL = form.attr('action');
    let msg;
    let groupForm = $('#form-group-name');

    $.ajax({
        type: 'post',
        url: formURL+'?'+form.serialize(),
        data: {
            'group_name': $('#group_name').val()
        }
    })
    .done( function (data) {
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
        groupForm.find('.error-msg').text('');
        groupForm.removeClass('has-error');
        $('#tbl_grupo').DataTable().ajax.reload();
        $('#group_name').val("");
        $('#modal-grupo').modal('hide');
    })
    .fail( function (res) {
        let error = res.responseJSON;

        for (let i in error['errors']) {
            let dta = error['errors'];
            msg = dta[i];
        }
        groupForm.find('.error-msg').text(msg);
        groupForm.addClass('has-error');
    });
});

$('#grp-edit').click(function (e) {
    e.preventDefault();

    let id = $('#grp-id').val();
    let form = $('#form-grp-update');
    let formURL = form.attr('action').replace('id', id)

    $.ajax({
        type: 'put',
        url: formURL+'?'+form.serialize(),
        data: {
            'group_name': $('#group_name').val()
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
        $('#tbl_grupo').DataTable().ajax.reload();
        clearGrp();
        $('#modal-grupo').modal('hide');
        $('#grp-edit').hide();
        $('#grupo').show();
    })
    .fail(function (res) {
        let error = res.responseJSON;
        console.log(error);
    });
});

// Funciones
function GrupoEdit(btn) {
    let Grp_id = btn.id;
    let formURL = GrpEdit.replace('id_group', Grp_id);

    $.ajax({
        type: 'get',
        url: formURL,
        dataType: 'json'
    })
    .done(function(data) {
        $('#grp-id').val(data.id)
        $('#title-modal').val('Editar Grupo');
        $('#grupo').hide();
        $('#grp-edit').show();
        $('#modal-grupo').modal('show');
        $('#group_name').val(data.group_name);
    })
    .fail(function(res) {
        let error = res.responseJSON;
        console.log(error);
    });
}

function clearGrp() {
    $('#group-name').val('');
    $('#grp-edit').hide();
    $('#grupo').show();
}
