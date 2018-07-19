$(window).on('load', null, {}, function() {
    $('.active').removeClass('active');
    $('#perfil').addClass('active');
    $('#perfil').parents('.droplink').addClass('active');
    $('#perfil').parents('.droplink').addClass('open');
    $('#perfil').parents('.sub-menu').css('display', 'block');
});

let imageForm = $('#imageForm');
let imageLogo = $('#imageLogo');
let ImageInput = $('#imageInput');
let imageURL = imageForm.attr('action');

$('.edit-image').click(function(){
    $('#imageInput').click();
});

ImageInput.on('change', function(){
    let formData = new FormData();
    formData.append('image', ImageInput[0].files[0]);

    $.ajax({
        url: imageURL+'?'+imageForm.serialize(),
        method: 'post',
        data: formData,
        processData: false,
        contentType: false,
    })
    .done(function (data) {
        if (data.success) {
            imageLogo.attr('src', '/images/'+data.path);
            $('#user_logo').attr('src', '/images/'+data.path);
            $('#user_avatar').attr('src', '/images/'+data.path);
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
        }
    })
    .fail(function (res) {
        alert('La imagen subida no tiene el formato correcto');
    });

});

$('#edit').click(function() {
    $('#address').removeAttr('readonly');
    $('#phone').removeAttr('readonly');
    $('#history').removeAttr('readonly');
    $('#mision').removeAttr('readonly');
    $('#vision').removeAttr('readonly');
    $(this).hide();
    $('#save-changes').show();
});

$('#save-changes').click( function (e) {
    e.preventDefault();

    let form = $('#form-edit-profile');
    let formURL = form.attr('action').replace('id', id);
    console.log(formURL);

    $.ajax({
        type: 'put',
        url: formURL+'?'+form.serialize(),
        data: {
            'address':  $('#address').val(),
            'phone':    $('#phone').val(),
            'history':  $('#history').val(),
            'mision':   $('#mision').val(),
            'vision':   $('#vision').val(),
        }
    })
    .done(function (data) {
        console.log(data);
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
        getIntitute();
        guardar();
    })
    .fail (function (res) {
        console.log(res);
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
            toastr.error(res, '¡Ups!');
        }, 100);
    });
});

function getIntitute(){
    $.ajax({
        type: 'get',
        url: GetInstURL
    })
    .done(function (data) {
        console.log($('#p-address')[0]);
        let user = data.user;
        let inst = data.inst;
        let address = inst.address;
        let phone = inst.phone;
        $('#p-address')[0].innerHTML = '<i class="fa fa-map-marker" id="i-address"></i> ' + address;
        $('#p-phone')[0].innerHTML = '<i class="fa fa-phone m-r-xs" id="i-phone"></i> '+ phone;
    })
    .fail(function (res) {

    });
}

function editar(){
    $('#address').removeAttr('readonly');
    $('#phone').removeAttr('readonly');
    $('#history').removeAttr('readonly');
    $('#mision').removeAttr('readonly');
    $('#vision').removeAttr('readonly');
    $('#edit').hide();
    $('#save-changes').show();
}

function guardar(){
    $('#address').attr('readonly', true);
    $('#phone').attr('readonly', true);
    $('#history').attr('readonly', true);
    $('#mision').attr('readonly', true);
    $('#vision').attr('readonly', true);
    $('#edit').show();
    $('#save-changes').hide();
}
