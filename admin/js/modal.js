$(function () {
  //Delete modal
  $('.delete-article').click(function () {

    $('#delete-modal-id').val($(this).data('id'));
    $('#delete-modal-name').text($(this).data('name'));
    $('#delete-modal-img').attr('src', $(this).data('imgSrc'));
    $('#delete-modal-link')
      .attr('href', 'php/actions/delete_article.php?article_id=' + $(this).data('id'));

    $('#delete-modal').css('display', 'flex');
  });
  $('#delete-modal-close-btn').click(function () {
    $('#delete-modal').css('display', 'none');
  });

  //Stock modal
  $('.stock-article').click(function () {

    $('#stock-modal-name').text($(this).data('name'));
    $('#stock-modal-img').attr('src', $(this).data('imgSrc'));

    $('#stock-modal-id').val($(this).data('id'));
    $('#stock-modal-value').val($(this).data('stock'));

    $('#stock-modal').css('display', 'flex');
  });
  $('#stock-modal-close-btn').click(function () {
    $('#stock-modal').css('display', 'none');
  });

  //Delete order modal
  $('.delete-order').click(function () {
    $('#delete-modal-id').val($(this).data('id'));
    $('#delete-modal-name').text($(this).data('name'));
    $('#delete-modal-link')
      .attr('href', 'php/actions/delete_order.php?order_id=' + $(this).data('id'));

    $('#delete-modal').css('display', 'flex');
  });
  $('#delete-modal-close-btn').click(function () {
    $('#delete-modal').css('display', 'none');
  });
});
