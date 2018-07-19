// Cuando Carge el navegador
$(document).ready( function () {
   getRoles();

   var phoneMask = new IMask(
      document.getElementById('phone'), {
      mask: '(000) 000 0000'
   });
});

// Eventos y Validaciones
$('#next').click( function() {
   if (!formsValidation()) {
      return false;
   } else {
      return true;
      $(location).attr('href', $(this).attr('href'));
   }
});

$('#username').on('keyup', function (e) {
   e.preventDefault();

   let username = $(this).val();
   let group = $('#username');

   if ($(this).val() === "") {
      $(this).addClass('is-invalid');
      group.removeClass('is-valid');
      $('.error-username').text("Este campo no puede estar vacío");
   } else {
      clearCreateUserError($(this).attr('id'));
      $(this).removeClass('is-invalid');
      $('.error-username').text("");

      $.ajax({
         type: 'get',
         url: "users/"+username,
         success: function (data) {
            let dta = data[0];
            if (dta) {
               group.addClass('is-invalid');
               group.removeClass('is-valid');
               $('.error-username').text("El nombre ya esta en uso");
            } else {
               group.addClass('is-valid');
               $('.error-username').text("");
            }
         }
      });
   }

});

$('#username').click( function () {
   if ($(this).val() === "") {
      $(this).addClass('is-invalid');
      $('.error-username').text("Este campo no puede estar vacío");
   }
});

$('#email').click( function () {
   if ($(this).val() === "") {
      $(this).addClass('is-invalid');
      $('.error-email').text("Este campo no puede estar vacío");
   }
});

$('#email').on('keyup', function () {
   let correo = $(this).val();
   let group = $(this);
   let email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{3,63}$/i;

   if ($(this).val() === "") {

      clearCreateUserError($(this).attr('id'));
      group.removeClass('is-valid');
      group.addClass('is-invalid');
      $('.error-email').text("Este campo no puede estar vacío");

   } else {

      if (email.test(group.val())) {
         $.ajax({
            type: 'get',
            url: "email/" + correo,
            success: function(data) {
               let dta = data[0];
               if (dta) {
                  if (dta['email'] === correo) {
                     $('.error-email').text("Este correo ya esta registrado");
                  } else {
                     group.removeClass('is-invalid');
                     group.addClass('is-valid');
                     $('.error-email').text("");
                  }
               } else {
                  group.removeClass('is-invalid');
                  group.addClass('is-valid');
                  $('.error-email').text("");
               }
            }
         });

      } else {

         group.removeClass('is-valid');
         group.addClass('is-invalid');
         $('.error-email').text("El correo no es válido");

      }

   }


});

$('#password').on('keyup', function () {
   let group = $(this);
   let pass = group.val();
   let password = /^[A-Z0-9-\w,.%+]{8,12}$/i;
   if (pass === "") {
      $(this).addClass('is-invalid');
      $('.error-password').text("Este campo no puede estar vacío");
   } else if (password.test(pass)) {
      $(this).removeClass('is-invalid');
      $(this).addClass('is-valid');
      $('.error-password').text("");
   } else {
      $(this).removeClass('is-valid');
      $(this).addClass('is-invalid');
      $('.error-password').text("La contraseña debe de tener letras o números min. 8");
   }
});

$('#password').on('click', function () {
   if ($(this).val() === "") {
      $(this).addClass('is-invalid');
      $('.error-password').text("Este campo no puede estar vacío");
   }
})

$('#password-confirmation').on('keyup', function () {
   let group = $(this);
   let pass = group.val();
   if (pass === "") {
      $(this).removeClass('is-valid');
      $(this).addClass('is-invalid');
      $('.error-confirmation').text("Este campo no puede estar vacío");
   } else if (pass != $('#password').val()) {
      $(this).removeClass('is-valid');
      $(this).addClass('is-invalid');
      $('.error-confirmation').text("La contraseña no coincide");
   } else {
      $(this).removeClass('is-invalid');
      $(this).addClass('is-valid');
      $('.error-confirmation').text("");
   }
});

$('#password-confirmation').on('click', function (e) {
   let group = $(this);
   let pass = group.val();
   if (pass === "") {
      $(this).addClass('is-invalid');
      $('.error-confirmation').text("Este campo no puede estar vacío");
   }
});

$('#input-file').click(function () {
   $('#img_inst').click();
});

$('#img_inst').change(function(){
   previewFile();
});

$('#schoolkey').click(function () {
   let grupo = $(this);
   let schoolkey = grupo.val();
   if (schoolkey === "") {
      $(this).removeClass('is-valid');
      $(this).addClass('is-invalid');
      $('.error-school').text("Este campo no puede estar vacío");
   }
});

$('#schoolkey').on('keyup', function () {
   let grupo = $(this);
   let schoolkey = grupo.val();
   let key = /^[A-Z0-9-]{10}$/i;
   if (schoolkey === "") {
      $(this).removeClass('is-valid');
      $(this).addClass('is-invalid');
      $('.error-school').text("Este campo no puede estar vacío");
   } else {

      if (key.test(schoolkey)) {
         $.ajax({
            type: 'get',
            url: "school/"+schoolkey,
            success: function(data) {
               let dta = data[0];
               if (dta) {
                  if (schoolkey === dta['schoolkey']) {
                     $('.error-school').text("Esta clave ya esta registrada");
                  } else {
                     grupo.removeClass('is-invalid');
                     grupo.addClass('is-valid');
                     $('.error-school').text("");
                  }
               } else {
                  grupo.addClass('is-valid');
                  grupo.removeClass('is-invalid');
                  $('.error-school').text("");
               }
            }
         });
      } else {
         grupo.removeClass('is-valid');
         grupo.addClass('is-invalid');
         $('.error-school').text("La clave escolar debe ser de 10 digitos y debe contener letras y numeros");
      }
   }
});

$('#address').click(function () {
   let grupo = $(this);
   let address = grupo.val();
   if (address === "") {
      $(this).removeClass('is-valid');
      $(this).addClass('is-invalid');
      $('.error-address').text("Este campo no puede estar vacío");
   }
});

$('#address').on('keyup', function() {
   let grupo = $(this);
   let address = grupo.val();
   if (address === "") {
      $(this).removeClass('is-valid');
      $(this).addClass('is-invalid');
      $('.error-address').text("Este campo no puede estar vacío");
   } else {
      $(this).removeClass('is-invalid');
      $(this).addClass('is-valid');
      $('.error-address').text("");
   }
});

$('#phone').click(function () {
   let grupo = $(this);
   let phone = grupo.val();
   if (phone === "") {
      $(this).removeClass('is-valid');
      $(this).addClass('is-invalid');
      $('.error-phone').text("Este campo no puede estar vacío");
   }
});

$('#phone').on('keyup', function () {
   let grupo = $(this);
   let phone = grupo.val();
   if (phone === "") {
      $(this).removeClass('is-valid');
      $(this).addClass('is-invalid');
      $('.error-phone').text("Este campo no puede estar vacío");
   } else {
      $(this).removeClass('is-invalid');
      $(this).addClass('is-valid');
      $('.error-phone').text("");
   }
});

// Funciones
function showCreateUserError(name, error) {
   let group = $('#form-group-' + name);
   group.addClass('is-invalid');
   group.find('.error-'+name).text(error);
}

function clearCreateUserError(name){
   let group = $('#' + name);
   group.removeClass('is-invalid');
   group.find('.error-'+name).text('');
}

function getRoles(){
   let group = $('#div-roles');
   let url = 'getRoles';

   $.ajax({
      type: 'get',
      dataType: 'json',
      url: url,
      success: function (data) {
         let html = "";
         for (let i in data) {
            let row = data[i];
            html += '<div class="col-md-3">';
            html += '<input type="radio" class="btn-radio" id="role-'+row['id']+'" name="roles" value="'+row['id']+'">';
            html += '<label for="role-'+row['id']+'" style="padding-left: 10px;">'+ row['role_name']+ '</label>';
            html += '</div>'
         }
         $('#div-roles').html(html);
      }
   });

}

function create_user(){

   const roles = $('.btn-radio:checked');
   const radio = roles[0];
   const formData = new FormData($('#form-store')[0]);
   console.log(formData);

   $.ajax({
      type: 'post',
      url: store,
      contentType: false,
      processData: false,
      headers: {'X-CSRF-TOKEN':token},
      data: formData,
      success: function (data) {
         let ok = data[0];
         console.log(ok);
         let auth = data;
         let error = data.responseJSON;
         if (auth) {
            console.log(data);
            location.href  =  admin;
         }
      },
      error: function (res) {
         let error = res.responseJSON;
         console.log(error);
         if(res.status == 422 ){
            for(let name in error['errors']){
                let d_error = error['errors'];
                let n_error = d_error[name];
                let m_error = n_error[0];
                showCreateUserError(name, m_error);
            }
        }
     }
   });
}

function formsValidation() {
   const name = $('#username');
   const email = $('#email');
   const password = $('#password');
   const password_confirmation = $('#password-confirmation');

   if (name.val() === "" && email.val() === "" && password.val() === "" && password_confirmation.val() === "") {
      name.addClass('is-invalid');
      $('.error-name').text("Este campo no puede estar vacío");
      email.addClass('is-invalid');
      $('.error-email').text("Este campo no puede estar vacío");
      password.addClass('is-invalid');
      $('.error-password').text("Este campo no puede estar vacío");
      password_confirmation.addClass('is-invalid');
      $('.error-confirmation').text("Este campo no puede estar vacío");
      return false;
   } else if (name.val() === "") {
      name.addClass('is-invalid');
      $('.error-name').text("Este campo no puede estar vacío");
      return false;
   } else if (email.val() === "") {
      email.addClass('is-invalid');
      $('.error-emai').text("Este campo no puede estar vacío");
      return false;
   } else if (password.val() === "" && password_confirmation.val() === "") {
      password.addClass('is-invalid');
      password_confirmation.addClass('is-invalid');
      $('.error-password').text("Este campo no puede estar vacío");
      $('.error-confirmation').text("Este campo no puede estar vacío");
      return false;
   } else if (password.val() === "") {
      password.addClass('is-invalid');
      $('.error-password').text("Este campo no puede estar vacío");
      return false;
   } else if (password_confirmation.val() === "") {
      password_confirmation.addClass('is-invalid');
      $('.error-confirmation').text("Este campo no puede estar vacío");
      return false;
   }

   return true;

}

function previewFile(){

   let preview  = document.querySelector('img[id=img]');
   let reader   = new FileReader();
   let file     = document.querySelector('input[type=file]').files[0];
   let fileSize = 0;
   let KByte    = 0;
   if (file) {
      fileSize = document.querySelector('input[type=file]').files[0].size;
      KByte = parseInt(fileSize/1024);
   }

   if (KByte > 3072) {
      alert('La imagen es muy grande');
      reader.abort();
   } else {

      reader.onload = function (){
         preview.src = reader.result;
      }

      if (file) {
         reader.readAsDataURL(file);
      }
      else {
         preview.src = "/home/img/icons/picture.png";
      }

   }

}
