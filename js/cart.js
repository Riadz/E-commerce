function formatPrice(price) {
  return price.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1 ');
}

function updateCartQuantity(pId, pQuan) {
  $.post(
    'cart_api/update_cart_quantity.php',
    {
      article_id: pId,
      article_quantity: pQuan
    },
    function (_data, status) {
      if (status == 'success') {
        showCartQuantity();
      } else {
        alert('connection error from cart');
      }
    }
  );
}

function showCartQuantity() {
  $.post('cart_api/show_cart.php', { article_quantity: 5 }, function (data, status) {
    if (status == 'success') {
      if (data != 'empty') {
        dataArray = JSON.parse(data);

        var nbArticle = 0;
        var prixTotal = 0;

        //cart items
        for (item of dataArray) {
          prixTotal += item.price * item.article_quantity;
          nbArticle += parseInt(item.article_quantity);
        }

        //cart total price
        var htmlPrix =
          `
          <div class="cart-pay-section-pricing">
            <span>` +
          nbArticle +
          ` Article :</span>
            <span>` +
          formatPrice(prixTotal) +
          ` DA</span>
          </div>
          <div class="cart-pay-section-pricing">
            <span>Shipping Tax :</span>
            <span>` +
          formatPrice(nbArticle * 100) +
          ` DA</span>
          </div>
          <div class="cart-pay-section-pricing">
            <span><h3>Total price :</h3></span>
            <span><h3>` +
          formatPrice(prixTotal + nbArticle * 100) +
          ` DA</h3></span>
          </div>
        `;

        //adding cart price
        $('#cart-pay-section').html(htmlPrix);
      } else {
        $('#cart-items-container').html('<h1> Le cart Est Vide </h1>');
        $('#cart-pay-section').html('');
      }
    } else {
      alert('connection error from cart');
    }
  });
}

function addCart(pId, pQuan) {
  $.post(
    'cart_api/add_cart.php',
    {
      article_id: pId,
      article_quantity: pQuan
    },
    function (_data, status) {
      if (status == 'success') {
        showCart();
        alert('Article added to cart! ');
      } else {
        alert('connection error from cart');
      }
    }
  );
}

function removeCart(pId) {
  $.post(
    'cart_api/remove_cart.php',
    {
      article_id: pId
    },
    function (_data, status) {
      if (status == 'success') {
        showCart();
      } else {
        alert('connection error from cart');
      }
    }
  );
}

function showCart() {
  $.post('cart_api/show_cart.php', function (data, status) {
    if (status == 'success') {
      if (data != 'empty') {
        dataArray = JSON.parse(data);

        var htmlItems = '';
        var nbArticle = 0;
        var prixTotal = 0;

        //les elemnt du cart
        for (item of dataArray) {
          htmlItems +=
            `
          <div class="cart-item">
            <a href="article?article_id=` +
            item.article_id +
            `" class="cart-item-disc">
              <img src="` +
            item.thumbnail_src +
            `" alt="image error" />
              <div class="cart-item-disc-name-price">
                <span>` +
            item.article_name +
            `</span>
                <span>` +
            formatPrice(item.price) +
            ` DA</span>
              </div>
            </a>
            <div class="cart-item-quantity">
              <span>Quantity:</span>
              <input name="quantity_` +
            item.article_id +
            `" value="` +
            item.article_quantity +
            `" article_id="` +
            item.article_id +
            `" min="1" max="` +
            item.article_max_quantity +
            `" type="number"
              class="cart-item-quantity-input" />
            </div>
            <button type="button" class="cart-item-delete-btn" article_id="` +
            item.article_id +
            `">
              <img src="img/trashcan.png" alt="image error" />
            </button>
          </div>
          `;

          prixTotal += item.price * item.article_quantity;
          nbArticle += parseInt(item.article_quantity);
        }

        //cart price
        var htmlPrix =
          `
          <div class="cart-pay-section-pricing">
            <span>` +
          nbArticle +
          ` Articles :</span>
            <span>` +
          formatPrice(prixTotal) +
          ` DA</span>
          </div>
          <div class="cart-pay-section-pricing">
            <span>Shipping Tax :</span>
            <span>` +
          formatPrice(nbArticle * 100) +
          ` DA</span>
          </div>
          <div class="cart-pay-section-pricing">
            <span><h3>Total price :</h3></span>
            <span><h3>` +
          formatPrice(prixTotal + nbArticle * 100) +
          ` DA</h3></span>
          </div>
        `;
        //show checkout button
        $('#pay-button').show();
        //add cart items
        $('#cart-items-container').html(htmlItems);
        //add cart price
        $('#cart-pay-section').html(htmlPrix);
      } else {
        $('#pay-button').hide();
        $('.nav-button').hide();
        $('#cart-items-container').html('<h1> Cart is empty </h1>');
        $('#cart-pay-section').html('');
      }
    } else {
      alert('connection error from cart');
    }
  });
}

$(function () {
  showCart();

  //toggle cart
  $('#cart-button').click(function () {
    $('#cart').slideToggle('fast');
  });
  //remove article
  $('#cart-items-container').on('click', '.cart-item-delete-btn', function () {
    var pId = $(this).attr('article_id');
    $(this)
      .parent()
      .hide('slow', function () {
        removeCart(pId);
      });
  });
  //update quantity
  $('#cart-items-container').on(
    'input',
    '.cart-item-quantity-input',
    function () {
      var pId = $(this).attr('article_id');

      var maxVal = parseInt($(this).attr('max'));

      if ($(this).val() == '' || $(this).val() <= 0) $(this).val('1');
      if ($(this).val() > maxVal) $(this).val(maxVal);

      var val = $(this).val();

      updateCartQuantity(pId, val);
    }
  );

  //add from index.php
  $('.article-add-to-cart-btn').click(function () {
    var pId = $(this).attr('article_id');
    addCart(pId, 1);
  });
  //add from article
  $('#add-to-cart-button').click(function () {
    var pId = $(this).attr('article_id');
    var pQuan = $('#add-to-cart-input').val();

    addCart(pId, pQuan);
  });
  //validate input in article
  $('#add-to-cart-input').on('input', function () {
    var maxVal = parseInt($(this).attr('max'));

    if ($(this).val() == '' || $(this).val() <= 0) $(this).val('1');
    if ($(this).val() > maxVal) $(this).val(maxVal);
  });
});
