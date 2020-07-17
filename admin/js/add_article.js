var imgInputCount = 0;

$(function () {
  //adding images
  $('#add-img-input-btn').click(function () {
    imgInputCount++;
    $('#add-img-input-btn').before(`
      <span>Image ${imgInputCount}</span>
      <input name="image_${imgInputCount}" type="file" accept="image/x-png,image/gif,image/jpeg" />
    `);
    checkImgInputCount();
  });

  //discout checkbox
  $('input[name="on_discount_checkbox"]').click(function () {
    if ($(this).is(':checked')) {
      $('input[name = "discount"]').prop('disabled', false);
      $('input[name = "new"]').prop('checked', false);
      $('input[name = "new"]').prop('disabled', true);
    } else {
      $('input[name = "discount"]').prop('disabled', true);
      $('input[name = "new"]').prop('disabled', false);
    }
  });

  //new checkbox
  $('input[name="new"]').click(function () {
    if ($(this).is(':checked')) {
      $('input[name = "on_discount_checkbox"]').prop('checked', false);
      $('input[name = "on_discount_checkbox"]').prop('disabled', true);
      $('input[name = "discount"]').prop('disabled', true);
    } else {
      $('input[name = "on_discount_checkbox"]').prop('disabled', false);
    }
  });

  //categories select
  updateCategoriesSelect();
  $('select[name="category_id"]')
    .change(function () {
      updateCategoriesSelect();
    });
});

function updateCategoriesSelect() {
  let categoryId = $('select[name="category_id"]').val();

  $('select[name="sub_category_id"]')
    .children()
    .hide();

  $('select[name="sub_category_id"]')
    .children()
    .prop('selected', false);

  $('select[name="sub_category_id"]')
    .children(`option[data-category-id="${categoryId}"]`)
    .show();

  $('select[name="sub_category_id"]')
    .children(`option[data-category-id="${categoryId}"]`)
    .first()
    .prop('selected', true);
}

function setImgInputCount(value) {
  imgInputCount = value;
}
function checkImgInputCount() {
  if (imgInputCount == 6) $('#add-img-input-btn').hide('slow');
}
