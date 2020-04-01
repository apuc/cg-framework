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

jQuery(document).ready(function ($) {
    $( ".module-download" ).click(function(e) {
        e.preventDefault();
        let slug = $(this).attr('data-name');
        console.log(slug);
        $.ajax({
            url: 'module-download',
            type: 'POST',
            data: {
                slug: slug
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
    $( ".module-set-active" ).click(function(e) {
        e.preventDefault();
        let slug = $(this).attr('data-name');
        console.log(slug);
        $.ajax({
            url: 'module-set-active',
            type: 'POST',
            data: {
                slug: slug
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
    $( ".module-set-inactive" ).click(function(e) {
        e.preventDefault();
        let slug = $(this).attr('data-name');
        console.log(slug);
        $.ajax({
            url: 'module-set-inactive',
            type: 'POST',
            data: {
                slug: slug
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