function changeFrom(event) {
  var clickedBtn = event.target;
  var activeBtn = document.getElementById('change-btn-active');

  document.getElementById(clickedBtn.getAttribute('data')).style.display =
    'block';

  var ids = ['trending', 'on-discount', 'new'];
  for (var i = 0; i < ids.length; i++)
    if (ids[i] != clickedBtn.getAttribute('data'))
      document.getElementById(ids[i]).style.display = 'none';

  activeBtn.removeAttribute('id');
  activeBtn.disabled = false;

  clickedBtn.setAttribute('id', 'change-btn-active');
  clickedBtn.disabled = true;
}
