function submit_vote(vote_type, _id, current) {
  $.ajax({
    type: "POST",
    url: base_url+"ajax/vote",
    async: true,
    data: {
      '_id': _id,
      'vote_type': vote_type
    },
    success: function (response) {
      var remove = $(current).attr('class').split(' ')[1];
      var current_class = $(current).attr('class').split(' ')[0];
      var _id = $(current).attr('id').split(' ')[0];
      var temp = (current_class === 'up')?$(current).parent().next('ul'):$(current).parent().prev('ul');
      var remove_class = temp.children().attr('class').split(' ')[2];
      switch (response) {
      case 'vote':
        if (current_class == 'down') {
          $(current).removeClass(remove).addClass("down_vote down" + _id);
          $('.' + remove_class).siblings().after('<p class="count">' + (parseInt($('.' + remove_class).siblings().text()) - 1) + '</p>').remove();
          $('.' + remove_class).removeClass().addClass('up no_vote');
        } else {
          $(current).removeClass(remove).addClass("up_vote up" + _id);
          $('.' + remove_class).siblings().after('<p class="count">' + (parseInt($('.' + remove_class).siblings().text()) - 1) + '</p>').remove();
          $('.' + remove_class).removeClass().addClass('down no_vote');
        }
        $(current).siblings().after('<p class="count">' + (parseInt(current.siblings().text()) + 1) + '</p>').remove();
        break;
      case 'remove_vote':
        $(current).siblings().after('<p class="count">' + (parseInt(current.siblings().text()) - 1) + '</p>').remove();
        $(current).removeClass().addClass(current_class + " no_vote");
        break;
      case 'login':
        alert('You need to login to vote.');
        break;
      default:
        // Do something when response != login, remove_vote, or vote.
      }
    }
  });
}

function submit_login_form() {
  $.ajax({
    type: "POST",
    url: base_url+"ajax/login",
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
    url: base_url+"ajax/register",
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

function refresh_page() {
  window.location.reload(true);
}

function logout() {
  $.post(base_url+"ajax/logout/",function(){refresh_page();});
}