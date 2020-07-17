window.onload = function() {
  getImages();
};

function getImages() {
  slideshowImages = document.getElementsByClassName('slideshow-img');
}

function openZoomModal() {
  document.getElementById('zoom-modal').style.display = 'flex';
}
function closeZoomModal(event) {
  if (event.target.id == 'zoom-modal' || event.target.id == 'zoom-close-btn')
    document.getElementById('zoom-modal').style.display = 'none';
}
