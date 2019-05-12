$('.addToCart').on('click', function(e) {
    var id = $(this).attr('id');
    $.ajax({
        type: 'POST',
        url: './browse.php',
        data: {
            cart: id
        }
    });
});