$('.addToCart').click(function() {
    var itemId = $(this).attr("id");
    var location = "./browse.php?action=additem&itemId=" + itemId;
    window.location.href = location;
});