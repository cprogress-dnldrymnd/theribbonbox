jQuery(document).ready(function($) {
  $('#custom-login-form-id').submit(function(e) {
    e.preventDefault();

    var username = $('#user_login').val();
    var password = $('#user_pass').val();
    var rememberme = $('#rememberme').is(':checked') ? 1 : 0;

    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajax_object.ajax_url,
      data: {
        action: 'custom_login_ajax_handler',
        username: username,
        password: password,
        rememberme: rememberme,
        security: '<?php echo wp_create_nonce( "ajax-login-nonce" ); ?>'
      },
      beforeSend: function() {
        $('.login-message').html('<p class="loading">Logging in...</p>');
      },
      success: function(response) {
        $('.login-message').html('<p>' + response.message + '</p>');
        if (response.loggedin === true) {
          window.location.href = '<?php echo esc_url( home_url() ); ?>';
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        $('.login-message').html('<p>Error: ' + errorThrown + '</p>');
      }
    });
  });
});
