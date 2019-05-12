var products = [];

$('.addToCart').click(function() {
    var itemId = $(this).attr("id");
    products.push(itemId);
});