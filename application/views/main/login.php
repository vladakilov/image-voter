<!-- Begin Login Form -->
<script>
function submit_login_form() {
  $.ajax({
    type: "POST",
    url: "ajax/post.php",
    data: {
	    'login': 'true',
      'username': $("#username_login").val(),
      'password': $("#password_login").val()
    },
    success: function (msg) {
      alert(msg);
    }
  });
}

function validate_login_form() {
  if ($('#username_login').val() == '') {
    alert('Please insert your username!');
    return false;
  }
  if ($('#password_login').val() == '') {
    alert('Please insert your password!');
    return false;
  }
  submit_login_form();
}
</script>
<div class="simple_overlay" id="login">
  <div id="user_login">
    <p>
      <label for="username">Username</label>
      <input type="text" name="username" id="username_login" size="30" maxlength="30" tabindex="1"/>
    </p>
    <p>
      <label for="password">Password</label>
      <input type="text" name="password" id="password_login" size="30" maxlength="30" tabindex="3"/>
    </p>
    <p>
      <input type="submit" id="login_dialog" value="Login" alt="Login" name="login" onClick="validate_login_form(); return false;"/>
    </p>
  </div>

  <div class="social_box">
    Facebook Users Login with: 
    <fb:login-button></fb:login-button>
  </div>

  <div class="social_box">
    Forgot your <a href="#">username</a> or <a href="#">password</a>?
  </div>
</div>
<!-- End Begin Login Form -->
