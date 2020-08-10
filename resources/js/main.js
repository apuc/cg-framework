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

            success: function () {
                location.reload();
            },
            error: function (res) {
                console.log(res);
            }
        });
    });

    $( ".action" ).click(function(e) {
        e.preventDefault();
        let theme = $(this).attr('data-theme');
        $.ajax({
            url: 'change-theme',
            type: 'POST',
            data: {
                theme: theme
            },

            success: function () {
                location.reload();
            },
            error: function (res) {
                console.log(res);
            }
        });
    });

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

            success: function () {
                location.reload();
            },
            error: function (res) {
                console.log(res);
            }
        });
    });

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

            success: function () {
                location.reload();
            },
            error: function (res) {
                console.log(res);
            }
        });
    });

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

            success: function () {
                location.reload();
            },
            error: function (res) {
                console.log(res);
            }
        });
    });

    $( ".theme-set-active" ).click(function(e) {
        e.preventDefault();
        let slug = $(this).attr('data-name');
        console.log(slug);
        $.ajax({
            url: 'theme-set-active',
            type: 'POST',
            data: {
                slug: slug
            },

            success: function () {
                location.reload();
            },
            error: function (res) {
                console.log(res);
            }
        });
    });

    $( ".module-delete" ).click(function(e) {
        e.preventDefault();
        let slug = $(this).attr('data-name');
        console.log(slug);
        $.ajax({
            url: 'module-delete',
            type: 'POST',
            data: {
                slug: slug
            },

            success: function () {
                location.reload();
            },
            error: function (res) {
                console.log(res);
            }
        });
    });
});