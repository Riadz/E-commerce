document
  .getElementById('category-container')
  .addEventListener('mouseleave', hideAllCategories);

let categoryButton = document.querySelectorAll('.category-button');
categoryButton.forEach(btn => {
  let divId = btn.dataset.categoryId;

  btn.addEventListener(
    'mouseenter',
    () => { showCategory(divId) }
  );
});

function showCategory(divId) {
  hideAllCategories();
  document
    .getElementById(`category-content-${divId}`)
    .style.display = 'block';
}

function hideAllCategories() {
  cates = document.getElementsByClassName('category-content');
  for (let i = 0; i < cates.length; i++) {
    cates[i].style.display = 'none';
  }
}
