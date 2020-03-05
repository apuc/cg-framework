jQuery(document).ready(function ($) {
    // $( ".view" ).click(function() {
    //     let url = $(this).attr('id');
    //     window.location.replace(url);
    // });

    $( ".edit" ).click(function() {
        let url = $(this).attr('id');
        window.location.replace(url);
    });

    $( ".delete" ).click(function() {
        let url = $(this).attr('id');

        $.ajax({
            url: 'delete',
            type: 'DELETE',
            data: {
                url: url
            },
            success: function (res) {
                console.log(res);
            },
            error: function (res) {
                console.log(res);
            }
        });
    });
});
