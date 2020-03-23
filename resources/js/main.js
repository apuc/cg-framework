jQuery(document).ready(function ($) {
    $( ".download" ).click(function(e) {
        e.preventDefault();
        let theme = $(this).attr('data-theme');
        $.ajax({
            url: 'download',
            type: 'POST',
            data: {
                theme: theme
            },

            success: function (res) {
                location.reload();
            },
            error: function (res) {
                console.log(res);
            }
        });
    });
});

jQuery(document).ready(function ($) {
    $( ".action" ).click(function(e) {
        e.preventDefault();
        let theme = $(this).attr('data-theme');
        $.ajax({
            url: 'set-theme',
            type: 'POST',
            data: {
                theme: theme
            },

            success: function (res) {
                location.reload();
            },
            error: function (res) {
                console.log(res);
            }
        });
    });
});