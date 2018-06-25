$('#login').click(function(e){
   e.preventDefault();
   let email = $('#email_log').val();
   let password = $('#password_log').val();

   $.ajax({
      type: 'post',
      url:  sesion,
      data: {
         'email': email,
         'password': password,
         '_token': token
      },
      success: function(res) {
         let auth = res[0];
         let error = res.responseJSON;
         if (auth) {
            console.log(res);
            location.href  =  admin;
         } else {
            for (let name in error['errors']) {
               let d_error = error['errors'];
               let n_error = d_error[name];
               let m_error = n_error[0];
               showLoginError(name, m_error);
            }
         }
      },
      error: function(res) {
         let error = res.responseJSON;
         console.log(error);
         for (let name in error['errors']) {
            let d_error = error['errors'];
            let n_error = d_error[name];
            let m_error = n_error[0];
            showLoginError(name, m_error);
         }
      }
   });

});

$('#email_log').on('keyup', function () {
   $(this).removeClass('is-invalid');
   $('.error-email_log').text('');
});

$('#password_log').on('keyup', function () {
   $(this).removeClass('is-invalid');
   $('.error-password_log').text('');
});

// Funciones y eventos
function showLoginError(name, error) {
   let group = $('#' + name +"_log");
   group.addClass('is-invalid');
   $('.error-'+name+"_log").text(error);
   group.find('.error-'+name+"_log").text(error);
}

function clearLoginError(name){
   let group = $('#' + name);
   group.removeClass('is-invalid');
   group.find('.error-'+name+"_log").text('');
}
