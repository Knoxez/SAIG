let tagForm = $('#form-tag-name');
let msg;

$(document).ready(function() {
    $('#tag-edit').hide();
});

$('#tag-store').click(function(e) {
    e.preventDefault();
    let form = $('#form-tag-store');
    let formURL = form.attr('action');

    $.ajax({
        type: 'post',
        url: formURL+'?'+form.serialize(),
        data: {
            'tag_name': $('#tag_name').val(),
        },
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
        $('#tbl_tag').DataTable().ajax.reload();
        cleanTag();
    }).fail(function(res) {
        let error = res.responseJSON;
        for (let i in error['errors']) {
            let dta = error['errors'];
            msg = dta[i];
        }
        tagForm.find('.error-msg').text(msg);
        tagForm.addClass('has-error');
    });
});

$('#tbl_tag').on('click', '.btn-tag-edit', function() {
    let id_tag = $(this).attr('id');
    let tagURL = tagShow.replace('id_tag', id_tag);

    $.ajax({
        type: 'get',
        url: tagURL,
        dataType: 'json'
    })
    .done(function(data) {
        $('#modal-tag').modal('show');
        $('#tag-store').hide();
        $('#tag-edit').show();
        $('#tag-id').val(data.id);
        $('#tag_name').val(data.tag_name);
        let title = $('#title-tag').text();
        let new_title = title.replace('Crear', 'Editar');
        $('#title-tag').text(new_title);
    });
});

$('#tag-edit').click(function(e) {
    let id_tag = $('#tag-id').val();
    let form = $('#form-tag-update');
    let formURL = form.attr('action').replace('id', id_tag);

    $.ajax({
        type: 'put',
        url: formURL+'?'+form.serialize(),
        data: {
            'tag_name': $('#tag_name').val()
        }
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
                "hideMethod": "fadeOut",
                "tapToDismiss": false
            };
            toastr.success(data, 'Éxito');
        }, 100);
        $('#tbl_tag').DataTable().ajax.reload();
        cleanTag();
    })
    .fail(function(res) {
        let error = res.responseJSON;
        for (let i in error['errors']) {
            let dta = error['errors'];
            msg = dta[i];
        }
        tagForm.find('.error-msg').text(msg);
        tagForm.addClass('has-error');
    });
});

$('#tbl_tag').on('click', '.btn-tag-delete', function() {
    let tr = $(this).parents('tr');
    let id_tag = $(this).attr('id');
    let form = $('#form-tag-delete');
    let formURL = form.attr('action').replace('id', id_tag);

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
            toastr.error('el tag no se ha podido eliminar', '¡Ups!');
        }, 100);
    });
});
// Funciones
function cleanTag() {
    $('#tag_name').val('');
    $('#tag-edit').hide();
    $('#tag-store').show();
    let title = $('#title-tag').text();
    let new_title = title.replace('Editar', 'Crear');
    $('#title-tag').text(new_title);
    tagForm.find('.error-msg').text('');
    tagForm.removeClass('has-error');

    $('#modal-tag').modal('hide');
}
