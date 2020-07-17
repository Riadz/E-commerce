function validatePassword() {
  password = document.querySelector('input[name="password"]');
  password_conf = document.querySelector('input[name="password_conf"]');

  if (password.value != password_conf.value)
    password_conf.setCustomValidity('Passwords are not matching');
  else password_conf.setCustomValidity('');
}
