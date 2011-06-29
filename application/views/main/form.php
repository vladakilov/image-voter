<script>
function submit_login_form() {
  $.ajax({
    type: "POST",
    url: "ajax/login",
    data: {
      'username': $("#username_login").val(),
      'password': $("#password_login").val()
    },
    success: function (msg) {
      switch (msg) {
      case 'Wrong username or password':
        alert(msg);
        break;
      default:
        refresh_page();
      }
    }
  });
}

function submit_register_form() {
  $.ajax({
    type: "POST",
    url: "ajax/register",
    data: {
      'username': $("#username").val(),
      'email': $("#email").val(),
      'password': $("#password").val(),
      'password2': $("#password2").val()
    },
    success: function (msg) {
      switch (msg) {
      case 'The username ' + $("#username").val() + ' is taken!':
        alert(msg);
        break;
      default:
        refresh_page();
      }
    }
  });
}

function validate_register_form() {
  var email = "^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$";
  if ($('#username').val() == '') {
    alert('Please insert your username!');
    return false;
  }
  if (!$('#email').val().match(email)) {
    alert('Please insert a valid email!');
    return false;
  }
  if ($('#password').val() == '') {
    alert('Please insert your password!');
    return false;
  }
  if ($('#password').val() !== $('#password2').val()) {
    alert('Your password does not match!');
    return false;
  }
  submit_register_form();
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

function refresh_page()
{
	window.location.reload(true);
}


function logout()
{
	$.post("CodeIgniter/ajax/logout/",function(){refresh_page();});
}
</script>

<!-- Begin Registration Form -->
<div class="simple_overlay" id="register">
  <div id="user_register">
      <p>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" size="30" maxlength="30" tabindex="1"/>
      </p>
      <p>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" size="30" maxlength="30" tabindex="2"/>
      </p>
      <p>
        <label for="password">Password</label>
        <input type="text" name="password" id="password" size="30" maxlength="30" tabindex="3"/>
      </p>
      <p>
        <label for="password2">Repeat Password</label>
        <input type="text" name="password2" id="password2" size="30" maxlength="30" tabindex="4"/>
      </p>
      <p>
        <input type="checkbox" id="terms" name="terms" value="yes" /> I agree with the Terms &amp; Conditions</br>
        <input type="checkbox" id="updates" name="updates" value="yes" /> Send Me Updates</br>
      </p>
      <p>
        <input type="button" value="Submit" id="submit_btn" alt="submit" name="submit" onClick="validate_register_form(); return false;">
      </p>
    </div>
  <div class="social_box">
    <fb:login-button></fb:login-button>
  </div>
</div>
<!-- End Registration Form -->

<!-- Begin Login Form -->
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

<a id="triggers" href="#" rel="#login"/>Login</a>
<a id="triggers" href="#" rel="#register"/>Register</a>
