<script>
function submit_login_form() {
  $.ajax({
    type: "POST",
    url: "index.php/ajax/login",
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

function submit_form() {
  $.ajax({
    type: "POST",
    url: "index.php/ajax/register",
    data: {
	    'register': 'true',
      'username': $("#username").val(),
      'email': $("#email").val(),
      'password': $("#password").val(),
      'password2': $("#password2").val()
    },
    success: function (msg) {
      alert(msg);
    }
  });
}

function validate_form() {
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
  submit_form();
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

<a id="triggers" href="#" rel="#login"/>Login</a>
<a id="triggers" href="#" rel="#register"/>Register</a>

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
        <input type="button" value="Submit" id="submit_btn" alt="submit" name="submit" onClick="validate_form(); return false;">
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

<!-- The loop to show all assets -->
<table>
	<?foreach ($documents as $document):?>
  <tr>
    <td><a href="#" class="up" id="<?=$document['_id']?>">Up Vote</a><p class="count"></p></td>
    <td><a href="#" class="down" id="<?=$document['_id']?>">Down Vote</a><p class="count"></p></td>
    <td><img src="index.php/main/image/<?=$document['md5']?>"/></td>
    <td><p><a href="index.php/main/image/<?=$document['md5']?>">View Image</a></p></td>
    <td><p><a href="user/"></a></p></td>
    <td><p></p></td>
  </tr>
  <?endforeach;?>
</table>
<!-- End loop -->
