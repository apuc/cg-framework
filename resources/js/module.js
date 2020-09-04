jQuery(document).ready(function ($) {
    $(document).on('click change', '.__cjax', function (e) {
        e.preventDefault();
        let data = JSON.stringify($(this).data());
        let changed = $(this).val();

        let action = $(this).data('action');
        let target = $(this).data('target');
        let type = $(this).data('type');
        if (!type) type = 'POST';

        $.ajax({
            url: action,
            type: type,
            data: {data: data, changed: changed},
            success: function (res) {
                let massage = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                    ' Дейтвие выполнено успешно' +
                    ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '   <span aria-hidden="true">&times;</span>' +
                    ' </button>' +
                    '</div>';
                if(action === "module-upload" || action === "module-update")
                    $('#' + target).html(massage + res);
                else $('#' + target).html(res);
            },
            error: function (res) {
                console.log(res);
            }
        });
    });
});