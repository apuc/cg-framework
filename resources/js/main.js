jQuery(document).ready(function ($) {
    $( "#download" ).click(function(e) {
        $.ajax({
            url: 'download',
            type: 'POST',

            success: function (res) {
                console.log(res);
            },
            error: function (res) {
                console.log(res);
            }
        });
    });
});