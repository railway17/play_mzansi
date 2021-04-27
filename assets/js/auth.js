$( document ).ready(function() {

  $('#btn_login').click(function() {
    $.ajax({
      url : base_url + 'login/signIn',
      dataType : 'json',
      method: 'post',
      data: {username: $('#username').val(), password: $('#password').val()},
      success : function (response) {
          if(response['statusCode'] == 200 && response['token']) {
            localStorage.setItem('authToken', response['token'])
            location.href = base_url + 'songs'
          } else {
            showToast('Error', response['message'], 'error')    
          }
      },
      error: function(result)
      {
        showToast('Error', result.toString(), 'error')
      }
    });
  })

  $('#btn_register').click(function() {
    $.ajax({
      url : base_url + 'register/signup',
      dataType : 'json',
      method: 'post',
      data: {username: $('#username').val(), password: $('#password').val()},
      success : function (response) {
          if(response['statusCode'] == 200 && response['token']) {
            localStorage.setItem('authToken', response['token'])
            location.href = base_url + 'songs'
          } else {
            showToast('Error', response['message'], 'error')    
          }
      },
      error: function(result)
      {
        showToast('Error', result.toString(), 'error')
      }
    });
  })
    
});

function makeAuthorizationHeader() {
  const authToken = localStorage.getItem('authToken')
  return `Bearer ${authToken}`
}
