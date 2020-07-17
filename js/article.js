//slideshow
setSlideshowCurrentImg();
//zoom
getZoomImgs();


//Slideshow
function setSlideshowCurrentImg() {
  currentImg = document.getElementById('slideshow-image-container')
    .firstElementChild;
}

function slideshowChangeImage(event) {
  var clickedImage = event.target;
  currentImg.setAttribute('src', clickedImage.getAttribute('src'));

  document.getElementById('active-slideshow-button').removeAttribute('id');
  clickedImage.setAttribute('id', 'active-slideshow-button');
}

//Zoom
function getZoomImgs() {
  zoomImgs = document.getElementsByClassName('slideshow-img');
  zoomModalImg = document.getElementById('zoom-modal-img');
}

function openZoomModal(event) {
  zoomModalImg.setAttribute('src', event.target.getAttribute('src'));
  document.getElementById('zoom-modal').style.display = 'flex';
}
function closeZoomModal(event) {
  if (event.target.id == 'zoom-modal' || event.target.id == 'zoom-close-btn')
    document.getElementById('zoom-modal').style.display = 'none';
}
function switchZoomImg(dirc) {
  for (let i = 0; i < zoomImgs.length; i++)
    if (zoomImgs[i].getAttribute('src') == zoomModalImg.getAttribute('src')) {
      var imgIndex;
      if (i + dirc >= 0) imgIndex = (i + dirc) % zoomImgs.length;
      else imgIndex = zoomImgs.length - 1;

      console.log(imgIndex);

      zoomModalImg.setAttribute('src', zoomImgs[imgIndex].getAttribute('src'));
      break;
    }
}
