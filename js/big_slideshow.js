const bgColor = 'var(--color-2)';

//getting all the button containers of all slide shows
let buttonsContainers = document.getElementsByClassName(
  'big-slideshow-buttons-container'
);
//adding event listeners for each button
for (let j = 0; j < buttonsContainers.length; j++) {
  const buttonsContainer = buttonsContainers[j];

  for (let i = 0; i < buttonsContainer.children.length; i++) {
    const button = buttonsContainer.children[i];

    button.addEventListener('click', changeSlideBS);
  }
}


function changeSlideBS(event) {
  let clickedButton = event.target;
  // getting the slides container , buttons container
  let buttonsContainer = clickedButton.parentElement;
  let slidesContainer = buttonsContainer.parentElement.children[0];
  // slide to slide to
  let slideId = clickedButton.dataset.slide - 1;
  // changing buttons color
  changeButtonsColorBS(buttonsContainer, slideId);
  //sliding
  scrollToSlide(slidesContainer.children[slideId]);
  // setting new current slide
  slidesContainer.dataset.currentSlide = slideId;
}

function swipeSlideBS(event, vect) {
  // getting the slides container
  let slidesContainer = event.target.parentElement.children[0];
  let buttonsContainer = event.target.parentElement.children[1];
  // slide to slide to
  let slideId =
    (parseInt(slidesContainer.dataset.currentSlide) + vect) %
    slidesContainer.children.length;
  if (slideId < 0) slideId = slidesContainer.children.length - 1;
  // changing buttons color
  changeButtonsColorBS(buttonsContainer, slideId);
  // sliding
  scrollToSlide(slidesContainer.children[slideId]);
  // setting new current slide
  slidesContainer.dataset.currentSlide = slideId;
}

function changeButtonsColorBS(buttonsContainer, slideId) {
  // changing the bg color of the buttons to transparent
  for (let i = 0; i < buttonsContainer.children.length; i++) {
    const button = buttonsContainer.children[i];

    button.style.background = 'transparent';
  }
  // changing the bg color of the clicked button
  buttonsContainer.children[slideId].style.background = bgColor;
}

function scrollToSlide(target) {
  target.scrollIntoView({
    behavior: 'smooth',
    block: 'end'
  })
}
