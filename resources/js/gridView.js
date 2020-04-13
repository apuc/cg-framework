jQuery(document).ready(function ($) {
    $( ".__delete" ).click(function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let url = $(this).attr('data-url');

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id: id
            },
            success: function () {
                window.location.reload();
            },
            error: function (res) {
                console.log(res)
            }
        });
    });
});
