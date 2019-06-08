$(".vin").keypress(function(e) {
    if (($this).val().length() != 17) {
        ($this).after('<span class="error">Must have 17 characters');
    }
});