$(function() {
  //modal open event
  $('.stocker').click(function(event) {
    var articleId = $(this).attr('article-id');
    var articleStock = $(this).attr('article-stock');

    $('#modal-id-input').val(articleId);
    $('#modal-stock-input').val(articleStock);

    $('#modal').css('display', 'flex');
  });
});
