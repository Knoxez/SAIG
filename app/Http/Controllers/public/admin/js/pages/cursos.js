$( document ).ready(function() {
    $('.active').removeClass('active');
    $('#cursos').addClass('active');
    $('#cursos').parents('.droplink').addClass('open');
    $('#cursos').parents('.sub-menu').css('display', 'block');
    ClearCurso();

    $('#curso-store').click(function (e) {
        e.preventDefault();

        let form = $('#form-curso');
        let formURL = form.attr('action');
        let select = $('#group').val();

        $.ajax({
            type: 'post',
            url: formURL+'?'+form.serialize(),
            data: {
                'name':  $('#curso_name').val(),
                'hours':    $('#hours').val(),
                'groups':   $('#group').val(),
                'description':  $('#details').val()
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
            $('#tbl_cursos').DataTable().ajax.reload();
            ClearCurso();
        })
        .fail(function(res){
            let error = res.responseJSON;
            let msg, dta, fail;
            for (let i in error['errors']) {
                dta = error['errors'];
                fail = dta[i];
                msg = fail[0];
                showCursosError(i, msg);
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

    $('#tbl_cursos tbody').on('click', '.btn-curso-edit', function(){
        ClearCurso();
        let curso_id = $(this).attr('id');
        let url = cursosEdit.replace('id', curso_id);

        $.ajax({
            type: 'get',
            url: cursosEdit.replace('id', curso_id),
            dataType: 'json'
        })
        .done(function(data) {
            let curso = data[0];
            let grupo = data[1];
            let select = $('#group');
            let array = [];
            $('#title-curso').text("Editar  Curso");
            $('#curso-id').val(curso['id']);
            $('#curso_name').val(curso['course_name']);
            $('#hours').val(curso['hours']);
            $('#details').val(curso['description']);

            for (let i in grupo) {
                let data = grupo[i];
                let id = data['id'];
                array[i] = id;
                let option = new Option(data.text, data.id, true, true);
                select.append(option).trigger('change');
            }
            $('#curso-store').hide();
            $('#curso-edit').show();
            $('#modal-curso').modal('show');
        })
        .fail(function(res) {
            let error = res.responseJSON;
            alert(res);
        });


    });

    $('#curso-edit').click(function(e) {
        e.preventDefault();
        let id_curso = $('#curso-id').val();
        let form = $('#form-curso-update');
        let formURL = form.attr('action').replace('id', id_curso);

        $.ajax({
            type: 'put',
            url: formURL+'?'+form.serialize(),
            data: {
                'name':  $('#curso_name').val(),
                'hours':    $('#hours').val(),
                'description':  $('#details').val(),
                'groups':   $('#group').val()
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
            $('#tbl_cursos').DataTable().ajax.reload();
            ClearCurso();
        })
        .fail(function(res) {
            let error = res.responseJSON;
            let dta, fail, msg;

            for (let i in error['errors']) {
                dta = error['errors'];
                fail = dta[i];
                msg = fail[0];

                showCursosError(i,msg);
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
                toastr.error('Error al editar el curso', '¡Ups!');
            }, 100);
        });

    });

    $('#tbl_cursos tbody').on('click', '.btn-curso-delete', function(){
        let id_curso = $(this).attr('id');
        let tr = $(this).parents('tr');
        let form = $('#form-curso-delete');
        let formURL = form.attr('action').replace('id', id_curso);

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
                toastr.error(error, '¡Ups!');
            }, 100);
        });

    });

});

function ClearCurso(){
    $('#title-curso').text("Crear Curso");
    $('#curso_name').val('');
    $('#hours').val('');
    $('#details').val('');
    $('#group').val('').trigger("change");
    $('#curso-id').val('');
    $('#curso-edit').hide();
    $('#curso-store').show();
    $('#modal-curso').modal('hide');
    $('.has-error').removeClass('has-error');
    $('.error-msg').text('');
}

function showCursosError(name, error) {
    let form = $('#form-curso-'+name);
    form.addClass('has-error');
    form.find('.error-msg').text(error);
}

function clearCursosEror(name) {
    let form = $('#form-curso-'+name);
    form.removeClass('has-error');
    form.find('.error.msg').text('');
}
