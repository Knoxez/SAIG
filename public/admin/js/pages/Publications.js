$(document).ready(function() {
    $('#publicaciones').addClass('active');
    let mensaje = localStorage.getItem("mensaje");
    console.log(mensaje);
    if (mensaje) {
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
            toastr.success(mensaje, 'Éxito');
        }, 100);
        localStorage.removeItem('mensaje');
    }
});

$('.btn_on').click(function(e) {
    e.preventDefault();
    let id_public = $(this).attr('id');
    let form = $('#form-public-update');
    let formURL = form.attr('action').replace('id', id_public);

    $.ajax({
        type: 'put',
        url: formURL+'?'+form.serialize(),
        data: {
            'status': $(this).text(),
        }
    })
    .done(function(data) {
        if (data === "Activado") {
            let span = $('a[id='+id_public+']');
            span.removeClass('on');
            span.addClass('off');
            let text = span.html();
            let new_text = text.replace('Activar', 'Desactivar');
            span.html(new_text);
        } else {
            $('#reload').load(window.location);
            let span = $('a[id='+id_public+']');
            span.removeClass('off');
            span.addClass('on');
            let text = span.html();
            let new_text = text.replace('Desactivar', 'Activar');
            span.html(new_text);
        }

    })
    .fail(function(res) {
        console.log('Error:', res.responseJson);
    });
});

$('#file-input').click(function(e){
    $('#publication_file').click();
});

$('#publication_file').on('change', function() {
    previewImage();
});

$('#btn-store').click(function(e) {
    e.preventDefault();
    let form = $('#form-publications');
    let formURL = form.attr('action');
    let formData = new FormData(form[0]);
    formData.append('code', $('#content').code());

    $.ajax({
        type: 'post',
        url: formURL+'?'+form.serialize(),
        contentType: false,
        processData: false,
        data: formData
    })
    .done(function(data) {
        localStorage.setItem("mensaje", data);
        location.href = index;
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
        if (res.status == 500) {
            toastr.error('Ha ocurrido un problema con el servidor, intenta recargar la pagina', 'Error');
        } else {
            toastr.error('No se ha podido crear la publicación, revisa bien los datos', '¡Ups!');
        }
        }, 100);
    });
});

// Funciones
function previewImage() {
    let preview = document.querySelector('img[id=publication-img]');
    let reader = new FileReader();
    let file = document.querySelector('input[type=file]').files[0];
    let fileSize = 0;
    let KByte = 0;
    if (file) {
        fileSize = document.querySelector('input[type=file]').files[0].size;
        KByte = parseInt(fileSize/1024);
    }

    if (KByte > 3072) {

        reader.abort();
    } else {
        reader.onload = function() {
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
